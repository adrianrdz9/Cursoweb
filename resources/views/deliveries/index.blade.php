@extends('layouts.app')

@section('content')
@inject('carbon', '\Carbon\Carbon')

@can('manage deliveriess')
<div class="container-fluid">
    <div class="container">
        <ul class="nav nav-pills" id="assignmentTabs" role="tablist">
    
            @foreach ($deliveries->groupBy('module_id') as $module => $a)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="pill" id="module{{ $module }}tab" href="#module{{ $module }}" role="tab">
                        {{ App\Module::find($module)['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content mt-4" id="modulesAssignments">
        @foreach ($deliveries->groupBy('module_id') as $module => $assignments)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="module{{ $module }}">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-2">
                        <div class="nav flex-column nav-pills" id="module{{ $module }}assignments" role="tablist" aria-orientation="vertical">
                            @foreach ($assignments as $assignment)
                                <a class="nav-link {{$loop->first ? 'active' : ''}}" id="tarea{{ $assignment->id }}" data-toggle="tab" href="#tareas{{ $assignment->id }}" role="tab"> {{ $assignment->title }} ( {{ $assignment->deliveries->count() }} ) </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach ($assignments as $assignment)
                                <div class="tab-pane fade {{$loop->first ? 'show active' : ''}}" id="tareas{{ $assignment->id }}" role="tabpanel" aria-labelledby="tarea{{ $assignment->id }}">
                                    <div class="card mb-4">
                                        <div class="card-body bg-info">
                                            <h1> {{ $assignment->title }} ({{ $assignment->module['name'] }}) </h1>
                                            <h2> Fecha limite: {{ $carbon->create($assignment->deadline)->isoFormat('MMMM D YYYY, h:mm a') }} </h2>
                                            {!! $assignment->description !!}
                        
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        @forelse ($assignment->deliveries->sortBy('mark') as $delivery)
                                            <div class="col-12 mt-4">
                                                <div class="card">
                                                    <div class="card-header bg-{{ $delivery->mark == null ? 'danger' : 'success' }}">
                                                        <h3>
                                                            {{ $delivery->user->name }}
                                                            ( {{ $delivery->mark == null ? 'No calificado' : 'Calificación: '.$delivery->mark }} )
                                                        </h3>
                                                        <strong>
                                                            Utima entrega: {{ $delivery->updated_at->isoFormat('MMMM D YYYY, h:mm a') }}
                                                        </strong>
                                                    </div>
                    
                                                    <div class="card-body" style="max-height: 200px; overflow-y: hidden;">
                                                        <a href="{{ $delivery->link }}">{{ $delivery->link }}</a>
                                                        {!! $delivery->comment !!}
                                                    </div>
                    
                                                    <div class="card-footer">
                                                        <a href="{{ route('delivery.show', ['id' => $delivery->id]) }}" class="btn btn-outline-info">Ver</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <h2>Aún no hay entregas</h2>
                    
                                        @endforelse
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
@else
<div class="container mt-1">
    <div class="row">
        <div class="col-md-9 offset-md-2">
            <h4>Entregas</h4>
            <ul class="timeline">
                @forelse ($deliveries as $delivery)
                    <li>
                        {{ $delivery->assignment->type }}:
                        <a target="_blank" href="{{ route('assignment.show', ['id'=>$delivery->assignment->id]) }}"> {{ $delivery->assignment->title }} <i class="fas fa-external-link-alt ml-1"></i></a>
                        @isset($delivery->mark)
                        <br>
                            <strong>Calificación: </strong>
                            {{ $delivery->mark }}
                        @endisset
                        <a href="{{ route('delivery.show', ['assignment_id' => $delivery->assignment->id]) }}" class="float-right">Ver ultima entrega ({{$delivery->updated_at->isoFormat('MMMM D YYYY, h:mm a') }}) <i class="fas fa-external-link-alt ml-1"></i></a>
                        <div style="max-height: 200px; overflow-x: scroll;">
                            <p>
                                <strong>Tu entrega:</strong><br>
                                <a href="{{ $delivery->link }}">{{ $delivery->link}}</a>
                                {!! $delivery->comment !!}
                            </p>
                        </div>
                    </li>
                @empty
                    <h3>Aun no entregas ningun trabajo</h3>
                @endforelse


            </ul>
        </div>
    </div>
</div>
    
@endcan
@endsection
