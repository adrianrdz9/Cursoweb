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
                    
                </div>
            </div>
        </div>
    </div>

@endsection