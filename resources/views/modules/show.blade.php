@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>{{ $module->name }}</h1>
                <strong> Duracion: {{ $module->hours }} horas. </strong>
            </div>

            <div class="card-body">
                <div class="card">

                    <div class="card-header">
                        <h3>Descripción del modulo</h3>
                    </div>

                    <div class="card-body">
                        {!! $module->description !!}
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Evaluación</h3>
                    </div>

                    <div class="card-body">
                        {!! $module->evaluation !!}
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h3> Profesores del modulo </h3>
                    </div>

                    <div class="card-body">
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

        </div>
    </div>
@endsection