@extends('layouts.app')
@section('content')
@inject('carbon', '\Carbon\Carbon')

    <div class="container">
        @can('create', \App\Post::class)
            <div class="col-12 text-right">
                <a href="{{ route('posts.create') }}" class="btn btn-success">Crear publicación</a>
            </div>
        @endcan
        <h1>Blog</h1>
        <span>
            Pagina {{ $posts->currentPage() }} de {{ $posts->lastPage() }}
        </span>
        
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-12 my-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $post->title }}</h3>
                            <strong> Por: {{ $post->author->name }} </strong><br>
                            <span>  {{ $post->created_at->isoFormat('MMMM D, YYYY') }} </span>
                        </div>

                        <div class="card-body" style="max-height: 200px; overflow-y: hidden;">
                            {!! $post->body !!}
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('posts.show', $post->id ) }}"><b>Ver</b></a>
                        </div>
                    </div>
                </div>
            @empty
                <h3>Aún no hay publicaciones</h3>
            @endforelse

            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
@endsection