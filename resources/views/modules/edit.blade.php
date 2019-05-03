@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('modules.update', ['id' => $module->id]) }}" method="post">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-6">
                    <label for="name">Nombre de modulo</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $module->name) }}">
                </div>
    
                <div class="col-6">
                    <label for="hours">Duración</label>
                    <div class="input-group">
                        <input type="number" name="hours" id="hours" class="form-control" value="{{ old('hours', $module->hours) }}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">horas</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $module->description) }}</textarea>
                </div>
    
    
                <div class="col-12">
                    <label for="evaluation">Evaluación</label>
                    <textarea name="evaluation" id="evaluation" cols="30" rows="10">{{ old('evaluation', $module->evaluation) }}</textarea>
                </div>

                <teacher-selection :t="{{ $module->teachers() }}"></teacher-selection>

                <div class="col-12 mt-3 w-75">
                    <input type="submit" value="Actualizar" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
@endsection
