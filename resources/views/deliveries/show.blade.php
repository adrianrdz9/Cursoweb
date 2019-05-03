@extends('layouts.app')

@section('content')
@inject('carbon', '\Carbon\Carbon')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>
                    Entrega de 
                    "
                    {{$assignment->title}}
                    "
                </h2>
                <span>
                    Entrega
                    {{ $carbon::create($assignment->deadline)->isoFormat('MMMM D YYYY, h:mm a') }}
                    (
                        {{ $carbon::create($assignment->deadline)->fromNow() }}
                    )
                </span>
            </div>
            @if( $assignment->delivered() )
                <div class="card-body">
                    <h4>Entregado</h4>
                    <div class="card">
                        <div class="card-header">
                            Entregado {{ $assignment->deliveredAt()->fromNow() }}
                        </div>
                        <div class="card-body">
                            Link: <a href="{{ $assignment->delivery()->link }}" target="_blank">{{ $assignment->delivery()->link }}</a> <br>
                            Comentario: {!! $assignment->delivery()->comment !!}
                        </div>
                    </div>
                </div>
                @isset($assignment->delivery()->mark)
                    <div class="card-footer">
                        <h4>Calificación</h4>
                        <div class="progress" style="height: 1em; font-size: 2em">
                            <div class="progress-bar bg-info lg" role="progressbar" style="width: {{ $assignment->delivery()->mark*10 }}%;" aria-valuenow="{{ $assignment->delivery()->mark }}" aria-valuemin="0" aria-valuemax="10">{{ $assignment->delivery()->mark }}</div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ 100 - $assignment->delivery()->mark*10 }}%;" aria-valuenow="{{ 10 -$assignment->delivery()->mark }}" aria-valuemin="0" aria-valuemax="10"></div>
                        </div>
                    </div>
                @else
                    <div class="card-footer">
                        <h4>Volver a entregar</h4>
                        <form action="{{ route('delivery.update', ['id' => $assignment->delivery()->id]) }}" method="POST">
                            @method('put')
                            <p>
                                Los archivos se deben de subir ya sea a github, gitlab, google drive, dropbox, etc. 
                                y compartir en un vínculo publico.
                                <br>
                                Si necesitas agregar algo más a la entrega puedes hacerlo en el comentario.
                                <br><br>
                                <strong>
                                    Recuerda que si vuelves a entregar un trabajo se considerará la fecha en la que lo volviste a entregar por lo que, si
                                    la nueva fecha de entrega se sale de la fecha limite de entrega tu trabajo podria aceptarse con menor calificación
                                    o no aceptarse.
                                </strong>
                            </p>
                            
                            @csrf

                            <label for="link">Link</label>
                            <input id="link" type="text" name="link" class="form-control" required placeholder="Link" value="{{ old('link', $assignment->delivery()->link) }}">
                            <br>

                            <label for="comment">Comentario adicional</label>
                            <textarea type="text" id="comment" name="comment" cols="30" rows="15">
                                {{ old('comment', $assignment->delivery()->comment) }}
                            </textarea>
        
                            <button class="btn btn-outline-success">Enviar</button>
                        </form>
                    </div>
                @endisset
            @else
                <form action="{{ route('delivery.store') }}" method="POST">
                    <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                    <div class="card-body">

                        <p>
                            Los archivos se deben de subir ya sea a github, gitlab, google drive, dropbox, etc. 
                            y compartir en un vínculo publico.
                            <br>
                            Si necesitas agregar algo más a la entrega puedes hacerlo en el comentario.
                        </p>
                        
                        @csrf

                        <label for="link">Link</label>
                        <input id="link" type="text" name="link" class="form-control" required placeholder="Link" value="{{ old('link') }}">

                        <br>
                        <label for="comment">Comentario adicional</label>
                        <textarea type="text" id="comment" name="comment" cols="30" rows="15">
                            {{ old('comment') }}
                        </textarea>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-outline-success">Enviar</button>
                    </div>
                </form>
            @endif

        </div>
    </div>

@endsection