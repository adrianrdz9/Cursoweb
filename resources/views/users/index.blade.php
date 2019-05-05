@extends('layouts.app')

@section('title', '| Users')

@section('content')

<div class="container">
    <h1>
        <i class="fa fa-users"></i> 
        Usuarios
    </h1>
    <div class="row">
        <div class="col-auto">
            <a href="{{ route('roles.index') }}" class="btn btn-default">Roles</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('permissions.index') }}" class="btn btn-default">Permissions</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Número de cuenta</th>
                    <th>Fecha/Hora de creación</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->account_number }}</td>
                        <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                        <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Editar</a>
                                </div>
                                <div class="col-auto">
                                    <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('delete')

                                        <input type="submit" value="Eliminar" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-success">Agregar usuario</a>

</div>

@endsection