@extends('layouts.app')

@section('title', '| Roles')

@section('content')

<div class="container">
    <h1>
        <i class="fa fa-key"></i>
        Roles
    </h1>

    <div class="row">
        <div class="col-auto">
            <a href="{{ route('users.index') }}" class="btn btn-default">Usuarios</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('permissions.index') }}" class="btn btn-default">Permisos</a>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Rol</th>
                    <th>Permisos</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>

                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <a href="{{ route('roles.edit', ['id' => $role->id])}}" class="btn btn-info">Editar</a>
                                </div>

                                <div class="col-auto">
                                    <form action="{{ route('roles.destroy', ['id' => $role->id]) }}" method="post">
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

    <a href="{{ route('roles.create') }}" class="btn btn-success">Agregar Rol</a>

</div>

@endsection