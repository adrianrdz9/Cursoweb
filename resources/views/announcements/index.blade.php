@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Administrar avisos</h1>
        <div class="d-block text-right">
            <a href="{{ route('announcements.create') }}" class="btn btn-success">Crear aviso</a>
        </div>

        <div class="row">
            @foreach ($announcements as $announcement)
                <div class="col-md-6 col-sm-12">
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3>{{ $announcement->title }}</h3>
                        </div>

                        <div class="card-body">
                            {!! $announcement->description !!}
                        </div>

                        <div class="card-footer">
                            @can('delete annoucements')
                                <form action="{{ route('announcements.destroy', ['id' => $announcement->id]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <input type="submit" value="Eliminar" class="btn btn-danger">
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection