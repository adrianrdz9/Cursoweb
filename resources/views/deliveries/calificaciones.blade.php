@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <ul class="nav nav-tabs" id="modulesTabs" role="tablist">
        
        @foreach ($modules as $module)
            <li class="nav-item">
                <a class="nav-link {{$loop->first ? 'active' : ''}}" id="{{$module->id}}-tab" data-toggle="tab" href="#content{{$module->id}}" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{$module->name}}</a>
            </li>
        @endforeach
    </ul>


    <div class="tab-content" id="modulesTabsContent">
        @foreach ($modules as $module)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content{{$module->id}}" role="tabpanel" aria-labelledby="{{$module->id}}-tab">                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-secondary">
                                <th scope="col">Nombre</th>
                                @foreach ($module->assignments as $assignment)
                                    <th scope="col">{{ str_limit($assignment->title, 15, '...') }}</th>
                                @endforeach
                            </tr>
                        </thead>
            
                        <tbody>
                            @foreach ($users as $user)
                                @if ($user->hasRole('student'))
                                    <tr>
                                        <th>
                                            {{ $user->name }}
                                        </th>

                                        @foreach ($module->assignments as $assignment)
                                            @php
                                                $cellDisplayed = false;
                                            @endphp
                                            @foreach ($user->deliveries as $delivery)
                                                @if($delivery->assignment_id == $assignment->id)
                                                    @isset($delivery->mark)
                                                        <th class="bg-{{ $delivery->mark > 8 ? 'success' : 'info' }}">
                                                            <a class="text-light" href="{{ route('delivery.show', ['id' => $delivery->id]) }}">
                                                                {{ $delivery->mark }}
                                                            </a>
                                                        </th>
                                                    @else
                                                        <th class="bg-warning">
                                                            <a href="{{ route('delivery.show', ['id' => $delivery->id]) }}">
                                                                /
                                                            </a>
                                                        </th>
                                                    @endisset
                                                    @php
                                                        $cellDisplayed = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if (!$cellDisplayed)
                                                <th class="bg-danger text-light">
                                                    /
                                                </th>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @endforeach
    </div>
    
</div>
@endsection

