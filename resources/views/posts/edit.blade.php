@extends('layouts.app')

@section('title', '| Edit Post')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Editar publicación</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('posts.update', ['id'=>$post->id]) }}" method="post">
                @csrf
                @method('patch')

                <label for="title">Título</label>
                <input type="text" class="form-control" required value="{{ old('title', $post->title) }}" name="title">

                <label for="body" class="mt-3">Cuerpo de la publicación</label>
                <textarea name="body" id="description" cols="30" rows="10">
                    {{ old('body', $post->body) }}
                </textarea>

                <button class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</div>

@endsection