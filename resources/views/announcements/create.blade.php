@extends('layouts.app')

@section('content')
    
    <div class="container">
        <form action="{{ $announcement->id == null ? '/announcements' : '/announcements/'.$announcement->id  }}" class="card" method="POST">
            @if( $announcement->id != null )
                @method('put')
            @endif

            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label for="title">Título</label>
                        <input id="title" type="text" name="title" value="{{ old('title', $announcement->title ) }}" class="form-control" placeholder="Título" required>
                    </div>
                    <div class="col-12">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Descripción">
                            {{ old('description', $announcement->description ) }}
                        </textarea>
                    </div>
                    <div class="col-12">
                        <label for="expiration">Expiración del aviso</label>
                        <input type="date" name="expiration" id="expiration" class="form-control" value="{{ old('expiration', $announcement->expiration ) }}" required>
                    </div>
                    
                </div>
            </div>


            <div class="card-footer">
                <button class="btn btn-{{ $announcement->id == null ? 'success' : 'info' }}">
                    @if( $announcement->id == null )
                        Crear
                    @else
                        Actualizar
                    @endif
                </button>
            </div>
        </form>
    </div>


@endsection
