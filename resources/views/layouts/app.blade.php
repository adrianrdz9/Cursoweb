<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta description="Sitio web dedicado a mejorar la experiencia de aprendizaje durante el curso web de prepa 6">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Curso web')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139192272-1"></script>
<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-139192272-1');</script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" title="Curso web" href="{{ url('/') }}">
                    <h1 class="h4">
                        {{ config('app.name', 'Curso web') }}
                    </h1>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @can('create assignments')
                            <li class="nav-item dropdown">
                                <a href="#" id="assignmentsDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Trabajos <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="assignmentsDropdown">
                                    <a href="{{ route('assignment.index') }}" class="dropdown-item">Todos</a>
                                    <a href="{{ route('assignment.create') }}" class="dropdown-item">Crear</a>
                                </div>
                            </li>
                        @elsecan('view assignments')
                            <li class="nav-item">
                                <a href="{{ route('assignment.index') }}" class="nav-link">Trabajos</a>
                            </li>
                        @endcan

                        @can('create useful resources')
                            <li class="nav-item dropdown">
                                <a href="#" id="usefulResourcesDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Recursos utiles <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="usefulResourcesDropdown">
                                    <a href="{{ route('resources.index') }}" class="dropdown-item">Todos</a>
                                    <a href="{{ route('resources.create') }}" class="dropdown-item">Crear</a>
                                </div>
                            </li>
                        @elsecan('view useful resources')    
                            <li class="nav-item">
                                <a href="{{ route('resources.index') }}" class="nav-link">Recursos útiles</a>
                            </li>
                        @endcan
  
                        @can('view calendar')
                            <li class="nav-item">
                                <a href="{{ route('calendar') }}" class="nav-link">Calendario</a>
                            </li>
                        @endcan

                        @can('view deliveries')
                            @can('mark deliveries')
                                <li class="nav-item">
                                    <a href="{{ route('delivery.index') }}" class="nav-link">Entregas</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('delivery.index') }}" class="nav-link">Mis entregas</a>
                                </li>
                            @endcan
                        @endcan

                        @can('create modules')
                            <li class="nav-item dropdown">
                                <a href="#" id="usersDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Modulos <span class="caret"></span>
                                </a>
    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="usersDropdown">
                                    <a href="{{ route('modules.index') }}" class="dropdown-item">Todos</a>
                                    <a href="{{ route('modules.create') }}" class="dropdown-item">Crear</a>
                                </div>
                            </li>
                        @elsecan('view modules')
                                <li class="nav-item">
                                    <a href="{{ route('modules.index') }}" class="nav-link">Modulos</a>
                                </li>
                        @endcan

                        @can('view all users')
                            <li class="nav-item dropdown">
                                <a href="#" id="usersDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Usuarios <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="usersDropdown">
                                    <a href="{{ route('roles.index') }}" class="dropdown-item">Roles</a>
                                    <a href="{{ route('permissions.index') }}" class="dropdown-item">Permisos</a>
                                    <a href="{{ route('users.index') }}" class="dropdown-item">Usuarios</a>
                                </div>
                            </li>
                        @endcan

                        {{-- @can('create exams')
                            <li class="nav-item dropdown">
                                <a href="#" id="blogDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Examenes <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="blogDropdown">
                                    <a href="{{ route('exams.index') }}" class="dropdown-item">Ver todos</a>
                                    <a href="{{ route('exams.create') }}" class="dropdown-item">Crear</a>
                                </div>
                            </li>
                        @elsecan('view exams')
                            <li class="nav-item">
                                <a href="{{ route('exams.index') }}">Examenes</a>
                            </li>
                        @endcan --}}

                        @can('create announcements')
                            <li class="nav-item">
                                <a href="{{ route('announcements.index') }}" class="nav-link">Anuncios</a>
                            </li>
                        @endcan
                        
                        @can('create posts')
                            <li class="nav-item dropdown">
                                <a href="#" id="blogDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Blog <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="blogDropdown">
                                    <a href="{{ route('posts.index') }}" class="dropdown-item">Todas las publicaciones</a>
                                    <a href="{{ route('posts.create') }}" class="dropdown-item">Publicar</a>
                                </div>
                            </li>
                        @elsecan('view posts')
                            <li class="nav-item">
                                <a href="{{ route('posts.index') }}">Blog</a>
                            </li>
                        @endcan


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a id="notificationsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-bell"></i>
                                    <span class="badge badge-pill badge-danger">
                                        {{ count(auth()->user()->unreadNotifications) }}
                                    </span>
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" style="max-height: 500px; overflow-y: scroll" aria-labelledby="notificationsDropdown">
                                    <h6 class="dropdown-header">Nuevas</h6>
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        @component('layouts.notificationTile', compact('notification'))
                                        @endcomponent
                                    @endforeach
                                    <h6 class="dropdown-header">Vistas</h6>
                                    @foreach (auth()->user()->readNotifications as $notification)
                                        @component('layouts.notificationTile', compact('notification'))
                                        @endcomponent
                                    @endforeach
                                </div>
                            </li>
                        @endauth

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" title="Login" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" title="Register" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @if (session('errors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('errors')->all() as $err)
                            <li>
                                {{$err}}
                            </li>                         
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('notice'))
            <div class="alert alert-info">
                <ul>
                   {{ session('notice') }}
                </ul>
            </div>
        @endif


            @yield('content')
        </main>
    </div>
</body>
</html>
