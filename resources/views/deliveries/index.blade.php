@extends('layouts.app')

@section('content')
@inject('carbon', '\Carbon\Carbon')

@can('manage deliveriess')
<div class="container">
    <ul class="nav nav-pills" id="assignmentTabs" role="tablist">

        @foreach ($deliveries as $assignment)
            <li class="nav-item">
                <a class="nav-link {{$loop->first ? 'active' : ''}}" id="tarea{{ $assignment->id }}" data-toggle="tab" href="#tareas{{ $assignment->id }}" role="tab" aria-controls="tareas" aria-selected="true"> {{ $assignment->title }} ( {{ $assignment->deliveries->count() }} ) </a>
            </li>
        @endforeach
    </ul>

    
    <div class="tab-content p-4" id="assignmentTabs">
        @foreach ($deliveries as $assignment)
        <div class="tab-pane fade {{$loop->first ? 'show active' : ''}}" id="tareas{{ $assignment->id }}" role="tabpanel" aria-labelledby="tarea{{ $assignment->id }}">
                <div class="card">
                    <div class="card-body">
                        <h2> Fecha limite: {{ $carbon->create($assignment->deadline)->isoFormat('MMMM D YYYY, h:mm a') }} </h2>
                        {!! $assignment->description !!}
    
                    </div>
                </div>
                <div class="row">
                    @forelse ($assignment->deliveries as $delivery)
                        <div class="col-12 mb-4">
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