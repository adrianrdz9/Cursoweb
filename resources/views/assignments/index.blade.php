@extends('layouts.app')

@section('content')

    <div class="container">
        <ul class="nav nav-pills" id="assignmentTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tareasT" data-toggle="tab" href="#tareas" role="tab" aria-controls="tareas" aria-selected="true">Tareas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ejerciciosT" data-toggle="tab" href="#ejercicios" role="tab" aria-controls="ejercicios" aria-selected="false">Ejercicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="practicasT" data-toggle="tab" href="#practicas" role="tab" aria-controls="practicas" aria-selected="false">Practicas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="proyectosT" data-toggle="tab" href="#proyectos" role="tab" aria-controls="proyectos" aria-selected="false">Proyectos</a>
            </li>
        </ul>
        <div class="tab-content p-4" id="assignmentTabs">
            <div class="tab-pane fade show active" id="tareas" role="tabpanel" aria-labelledby="tareasT">
                <div class="row">
                    @isset($assignments['Tarea'])
                        @forelse ($assignments['Tarea'] as $assignment)
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
            <div class="tab-pane fade" id="ejercicios" role="tabpanel" aria-labelledby="ejerciciosT">
                <div class="row">
                    @isset($assignments['Ejercicio'])
                        @forelse ($assignments['Ejercicio'] as $assignment)
                            <div class="col-12 mt-4">
                                @component('assignments._card', ['assignment' => $assignment]) 
                                @endcomponent
                            </div>
                        @endforeach
                    @else
                        <h3>No hay ejercicios</h3>
                    @endisset
                </div>
            </div>
            <div class="tab-pane fade" id="practicas" role="tabpanel" aria-labelledby="practicasT">
                <div class="row">
                    @isset($assignments['Practica'])
                        @foreach ($assignments['Practica'] as $assignment)
                            <div class="col-12 mt-4">
                                @component('assignments._card', ['assignment' => $assignment]) 
                                @endcomponent
                            </div>
                        @endforeach
                    @else
                        <h3>No hay practicas</h3>
                    @endisset
                </div>
            </div>
            <div class="tab-pane fade" id="proyectos" role="tabpanel" aria-labelledby="proyectosT">
                <div class="row">
                    @isset($assignments['Proyecto'])
                        @foreach ($assignments['Proyecto'] as $assignment)
                            <div class="col-12 mt-4">
                                @component('assignments._card', ['assignment' => $assignment]) 
                                @endcomponent
                            </div>
                        @endforeach
                    @else
                        <h3>No hay proyectos</h3>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection