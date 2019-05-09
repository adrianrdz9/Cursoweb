@extends('layouts.app')

@section('content')
    
    <div class="container">
        @foreach ($modules as $module)
            @if ($module->name != "Laravel" || auth()->user()->can('view laravel module'))
                <div class="card mt-3">
                    <div class="card-header">
                        <h2>{{ $module->name }}</h2>
                        <strong>Duración: {{ $module->hours }} horas</strong>
                    </div>

                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <h3>Descripción del curso</h3>
                            </div>

                            <div class="card-body" style="max-height: 150px; overflow-y: hidden">
                                {!! $module->description !!}
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3>Evaluación</h3>
                            </div>

                            <div class="card-body" style="max-height: 150px; overflow-y: hidden">
                                {!! $module->evaluation !!}
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3>Profesores del módulo</h3>
                            </div>

                            <div class="card-body" style="max-height: 250px; overflow-y: scroll">
                                <ul class="list-group">
                                    @foreach ($module->teachers() as $teacher)
                                        <li class="list-group-item">
                                            <h5>
                                                {{ $teacher->name }}
                                            </h5>
                                            <p>
                                                {{ $teacher->email }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('modules.show', ['id' => $module->id]) }}">Ver más</a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

@endsection
