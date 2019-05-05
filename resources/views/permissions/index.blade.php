@extends('layouts.app')

@section('title', '| Permisos')

@section('content')

<div class="container">
    <h1>
        <i class="fa fa-key"></i>
        Permisos disponibles
    </h1>

    <div class="row">
        <div class="col-auto">
            <a href="{{ route('users.index') }}" class="btn btn-default">Usuarios</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('roles.index') }}" class="btn btn-default">Roles</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        Permiso
                    </th>
                    <th>
                        Acción
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <a href="{{ route('permissions.edit', ['id'=>$permission->id]) }}" class="btn btn-info">
                                        Editar
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <form action="{{ route('permissions.destroy', ['id' => $permission->id]) }}" method="post">
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
    <a href="{{ route('permissions.create') }}" class="btn btn-success">Agregar permiso</a>
</div>

@endsection