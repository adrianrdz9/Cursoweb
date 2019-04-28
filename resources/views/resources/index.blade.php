@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Recursos útiles</h1>
        @foreach ($resources as $resource)
            <div class="card">
                @switch($resource->type)
                    @case('Imagen')
                        <div class="card-header bg-primary text-light">   
                        @break
                    @case('Video')
                        <div class="card-header bg-info">                           
                        @break
                    @case('Artículo')
                        <div class="card-header bg-success">   
                        @break
                    @case('Animación')
                        <div class="card-header bg-warning">   
                        @break
                    @case('Sitio web')
                        <div class="card-header bg-danger">   
                        @break
                    @default
                        <div class="card-header bg-secondary text-light">   
                        @break                        
                @endswitch
                    <div class="row justify-content-between">
                        <div class="col">
                            <h2> {{ $resource->title }} </h2>
                        </div>

                        <div class="col text-right">
                            <strong>{{ $resource->type }}</strong>
                        </div>
                    </div>
                </div>

                <div class="card-body" style="max-height: 300px; overflow-y: scroll;">
                    {!! $resource->description !!}
                </div>

                <div class="card-footer">
                    @isset($resource->link)
                        <a href="{{ $resource->link }}">{{ $resource->link }}</a>
                    @endisset

                    <a href="{{ route('resources.show', ['id'=>$resource->id]) }}" class="btn btn-info">Ver</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection