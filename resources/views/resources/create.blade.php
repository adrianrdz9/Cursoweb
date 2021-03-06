@extends('layouts.app')

@section('content')
    
    <div class="container">
        <form action="{{ $resource->id == null ? '/resources' : '/resources/'.$resource->id  }}" class="card" method="POST">
            @if( $resource->id != null )
                @method('put')
            @endif

            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label for="title">Título</label>
                        <input id="title" type="text" name="title" value="{{ old('title', $resource->title ) }}" class="form-control" placeholder="Título" required>
                    </div>
                    <div class="col-12">
                        <label for="type">Tipo</label>
                        <select name="type" id="type" class="form-control" required>
                            @php
                                $opts = ['Imagen', 'Video', 'Artículo', 'Animación', 'Sitio web', 'Otro'];
                            @endphp

                            @foreach ($opts as $opt)
                                <option 
                                    value="{{ $opt }}"
                                    {{ old('type', $resource->type ) == $opt ? 'selected' : '' }}
                                >{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="description">Descripción (opcional)</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Descripción">
                            {{ old('description', $resource->description ) }}
                        </textarea>
                    </div>
                    <div class="col-12">
                        <label for="link">Link al recurso (opcional)</label>
                        <input id="link" type="url" name="link" value="{{ old('link', $resource->link ) }}" class="form-control" placeholder="Link">
                    </div>


                </div>
            </div>


            <div class="card-footer">
                <button class="btn btn-{{ $resource->id == null ? 'success' : 'info' }}">
                    @if( $resource->id == null )
                        Crear
                    @else
                        Actualizar
                    @endif
                </button>
            </div>
        </form>
    </div>


@endsection
