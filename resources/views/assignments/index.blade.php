@extends('layouts.app')

@section('content')

    <div class="container">
        <ul class="nav nav-pills" id="assignmentTabs" role="tablist">
            @foreach ($modules as $module)
                <li class="nav-item">
                    <a class="nav-link {{$loop->first ? 'active' : ''}}" id="tab{{ $module->id }}" data-toggle="tab" href="#mod{{ $module->id }}" role="tab" aria-controls="mod{{ $module->id }}" aria-selected="true">{{ $module->name }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content p-4" id="assignmentTabs">
            @foreach ($modules as $module)
                <div class="tab-pane fade {{$loop->first ? 'show active' : ''}}" id="mod{{ $module->id }}" role="tabpanel" aria-labelledby="tab{{ $module->id }}">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach ($module->assignments->groupBy('type') as $type=>$assignments)
                                    <a class="nav-link {{ $loop->first ? 'active' : ''}}" id="type{{$type}}{{ $module->id }}" data-toggle="pill" href="#type{{$type}}{{ $module->id }}view" role="tab" aria-controls="type{{$type}}{{ $module->id }}view" aria-selected="true">{{$type}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                @foreach ($module->assignments->groupBy('type') as $type=>$assignments)
                                    <div class="tab-pane fade  {{ $loop->first ? 'show active' : ''}}" id="type{{$type}}{{ $module->id }}view" role="tabpanel" aria-labelledby="type{{$type}}{{ $module->id }}">
                                        <h3>{{ $type }} módulo {{ $module->name }}</h3>
                                        <div class="row">
                                            @isset($assignments)
                                                @forelse ($assignments as $assignment)
                                                    <div class="col-12 mt-4">
                                                        @component('assignments._card', ['assignment' => $assignment]) 
                                                        @endcomponent
                                                    </div>
                                                @endforeach
                                            @else
                                                <h3>No hay tareas</h3>
                                            @endisset
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>     
                </div>
            @endforeach
                    
                    
        </div>
    </div>
@endsection