@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Administrar avisos</h1>
        <div class="d-block text-right">
            <a href="{{ route('announcements.create') }}" class="btn btn-success">Crear aviso</a>
        </div>

        {{ $announcements }}

    </div>
@endsection