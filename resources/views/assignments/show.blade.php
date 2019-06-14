@extends('layouts.app')

@section('content')
    @inject('carbon', '\Carbon\Carbon')
    

    <div class="container">
        @component('assignments._card', ['assignment' => $assignment])
            @slot('footer')
                @if(auth()->user()->hasRole('student'))
                    @if($assignment->delivered())
                        <span>
                            Entregado
                            {{ $assignment->deliveredAt()->fromNow() }}
                        </span>
                        <a href="{{ route('delivery.show', ['assignment_id' => $assignment->id]) }}">Ver entrega</a>
                        <a class="btn btn-secondary" href="{{ route('delivery.show', ['assignment_id' => $assignment->id]) }}">Volver a entregar</a>
                    @else

                        <span>
                            No entregado
                        </span>
                        <a href="{{ route('delivery.show', ['assignment_id' => $assignment->id]) }}" class="btn btn-outline-success">Entregar</a>

                    @endif
                @endif

		@can('edit assignment')
			<a href="{{ route('assignment.edit', ['id' => $assignment->id]) }}" class="btn btn-info"> Editar </a>
		@endcan
            @endslot
        @endcomponent
        <div class="card mt-4">
            <div class="card-header">
                <h3>Comentarios</h3>
            </div>

            <comments-component :assignment_id="{{ $assignment->id }}"></comments-conmponent>

        </div>
    </div>


@endsection
