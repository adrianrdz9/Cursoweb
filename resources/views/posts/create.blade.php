@extends('layouts.app')

@section('title', '| Create New Post')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Publicar</h1>
            </div>

            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Título" required value="{{ old('title') }}">

                    <label for="body" class="mt-2">Cuerpo de publicación</label>
                    <textarea name="body" id="description" cols="30" rows="10">
                        {{ old('body') }}
                    </textarea>

                    <input type="submit" value="Publicar" class="btn btn-success btn-lg btn-block mt-4">
                </form>
            </div>
        </div>
    </div>

@endsection