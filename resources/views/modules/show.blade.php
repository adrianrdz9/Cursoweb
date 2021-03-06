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
                        <h3>Descripción del módulo</h3>
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
                        <h3> Profesores del módulo </h3>
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

            <div class="card-footer">
                @can('edit modules')
                    <a href="{{ route('modules.edit', ['id' => $module->id]) }}">Editar</a>
                @endcan

                @can('delete modules')
                    <form action="{{ route('modules.destroy', ['id' => $module->id]) }}" method="post">
                        @csrf
                        @method('delete')

                        <input type="submit" value="Eliminar módulo" class="btn btn-danger">
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection