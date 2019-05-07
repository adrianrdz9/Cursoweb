@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h3>
                    {{ $resource->title }}
                    (
                        {{ $resource->type }}
                    )
                </h3>
            </div>

            <div class="card-body">
                @isset($resource->description)
                    {!! $resource->description !!}
                @else
                    No hay descripción
                @endisset
                <hr>
                @isset($resource->link)
                    <a href="{{ $resource->link }}">
                        {{ $resource->link }}
                    </a>
                @else
                    Link no disponible
                @endisset
            </div>

            <div class="card-footer">
                <div class="row">
                    @can('delete resources')
                        <form action="{{ route('resources.destroy', ['id' => $resource->id]) }}" method="post">
                            @csrf
                            @method('delete')

                            <input type="submit" value="Eliminar" class="btn btn-danger">
                        </form>
                    @endcan

                    @can('edit resources')
                        <a href="{{ route('resources.edit', ['id' => $resource->id]) }}" class="btn btn-info">
                            Editar
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>

@endsection