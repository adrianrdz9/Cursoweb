@extends('layouts.app')

@section('content')
    
    <div class="container">
        <form action="{{ $assignment->id == null ? '/assignment' : '/assignment/'.$assignment->id  }}" class="card" method="POST">
            @if( $assignment->id != null )
                @method('put')
            @endif

            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label for="title">Título</label>
                        <input id="title" type="text" name="title" value="{{ old('title', $assignment->title ) }}" class="form-control" placeholder="Título" required>
                    </div>
                    <div class="col-12">
                        <label for="deadline">Fecha límite</label>
                        <datetime id="deadline" format="y-LL-dd HH:mm:ss" type="datetime" name="deadline" value="{{ old('deadline', $assignment->deadline ) }}" placeholder="Fecha límite" aria-required="true"></datetime>
                    </div>
                    <div class="col-12">
                        <label for="description">Descripción (opcional)</label>
                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Descripción">
                            {{ old('description', $assignment->description ) }}
                        </textarea>
                    </div>
                    <div class="col-12">
                        <label for="example">Ejemplo (opcional)</label>
                        <input id="example" type="text" name="example" value="{{ old('example', $assignment->example ) }}" class="form-control" placeholder="Ejemplo">
                    </div>
                    <div class="col-12">
                        <label for="type">Tipo</label>
                        <select name="type" id="type" class="form-control" required>
                            @php
                                $opts = ['Tarea', 'Ejercicio', 'Practica', 'Proyecto'];
                            @endphp

                            @foreach ($opts as $opt)
                                <option 
                                    value="{{ $opt }}"
                                    {{ old('type', $assignment->type ) == $opt ? 'selected' : '' }}
                                >{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <div class="card-footer">
                <button class="btn btn-{{ $assignment->id == null ? 'success' : 'info' }}">
                    @if( $assignment->id == null )
                        Crear
                    @else
                        Actualizar
                    @endif
                </button>
            </div>
        </form>
    </div>


@endsection

<script>
    function wait(){
        try{
            ClassicEditor
                .create( document.querySelector( '#description' ) )
        }catch(e){
            setTimeout(wait, 20);
        }
    }
    wait();
</script>