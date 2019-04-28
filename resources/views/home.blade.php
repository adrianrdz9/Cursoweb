@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>
            Inicio curso web 2019
        </h1>  

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header bg-blue text-light">
                        <h2>Avisos</h2>
                    </div>

                    <div class="card-body bg-light-blue">
                        <div class="row">
                            @forelse ($announcements as $announcement)
                                <div class="col-12 my-2">
                                    <div class="card mt-2">
                                        <div class="card-header bg-info">
                                            <h3>{{ $announcement->title }}</h3>
                                        </div>
                
                                        <div class="card-body">
                                            {!! $announcement->description !!}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3>No hay avisos nuevos</h3>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-orange mt-4">
                        <h2>Ultimas publicaciones del blog</h2>
                    </div>

                    <div class="card-body bg-light-orange">
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
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header bg-green">
                        <h2>Notificaciónes</h2>
                    </div>

                    <div class="card-body bg-light-green">
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group">
                                    <h4>Nuevas</h4>
                                    @forelse ($notifications['unread'] as $notification)
                                        <form action="{{ route('notification.show', ['id' => $notification->id]) }}" method="post">
                                            @csrf
                                            <button class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{ $notification->data["title"] }}</h5>
                                                    <small class="text-muted">{{ $notification->created_at->fromNow() }}</small>
                                                </div>
                                                <small class="text-muted">{{ $notification->data['subtitle'] }}</small>
                                                <p class="mb-1">{{ $notification->data['description'] }}</p>
                                            </button>
                                        </form>
                                    @empty
                                        <h5>No hay notificaciones nuevas</h5>
                                    @endforelse
                                    <h4>Vistas</h4>
                                    @forelse ($notifications['read'] as $notification)
                                        <form action="{{ route('notification.show', ['id' => $notification->id]) }}" method="post">
                                            @csrf
                                            <button class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{ $notification->data["title"] }}</h5>
                                                    <small class="text-muted">{{ $notification->created_at->fromNow() }}</small>
                                                </div>
                                                <small class="text-muted">{{ $notification->data['subtitle'] }}</small>
                                                <p class="mb-1">{{ $notification->data['description'] }}</p>
                                            </button>
                                        </form>
                                    @empty
                                        <h5>No hay nada</h5>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header bg-teal">
                        <h2>Trabajos recientes recientes</h2>
                    </div>

                    <div class="card-body bg-light-teal">
                        <div class="row">
                            @forelse ($assignments as $assignment)
                                <div class="col-12 my-2">
                                    @component('assignments._card', compact('assignment'))
                                        
                                    @endcomponent
                                </div>
                            @empty
                                <h3>Aún no hay tareas</h3>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>

@endsection
