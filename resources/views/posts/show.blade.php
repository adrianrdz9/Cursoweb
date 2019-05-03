@extends('layouts.app')

@section('title', '| View Post')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{ $post->title }}</h1>
        </div>

        <div class="card-body">
            {!! $post->body !!}
        </div>

        <div class="card-footer">
            <div class="row">
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger mr-3">Eliminar</button>
                    </form>
                @endcan
    
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">Edit</a>
                @endcan
            </div>
        </div>
    </div>
</div>

@endsection