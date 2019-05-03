@inject('carbon', '\Carbon\Carbon')


<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h2>
                    {{ $assignment->title }}
                </h2>
            </div>
            <div class="col-3">
                <strong>
                    {{ $assignment->type }}
                </strong>
            </div>
            <div class="col-3">
                <span
                    style="color: {{$carbon::create($assignment->deadline) >= $carbon::now() ? 'green' : 'red' }}"
                >
                    Entrega: 
                    {{ $carbon::create($assignment->deadline)->isoFormat('MMMM D YYYY, h:mm a') }}
                    <br>
                    @if ($carbon::create($assignment->deadline) >= \Carbon\Carbon::now())
                        Dentro de tiempo,
                    @else
                        Fuera de tiempo,
                    @endif
                    {{ $carbon::create($assignment->deadline)->fromNow() }}
                </span>
            </div>
        </div> 
    </div>

    <div class="card-body">
        @isset($assignment->description)
            {!! $assignment->description !!}
        @else
            No hay descripción
        @endisset
    </div>
    <div class="card-footer">
        @empty($footer)
            @role('student')
                <a class="btn btn-info" href="{{ route('assignment.show', [$assignment])}}">Ver</a>
                <span>
                    @if ($assignment->delivered())
                        Entregado
                        {{ $assignment->deliveredAt()->fromNow() }}
                    @else
                        No entregado
                    @endif
                </span>
            @else
                @can('view assignments')
                    <a class="btn btn-info" href="{{ route('assignment.show', [$assignment])}}">Ver</a>
                @endcan

                @can('delete assignments')
                    <form action="{{ route('assignment.destroy', ['id' => $assignment->id]) }}" method="POST">
                        @csrf
                        @method('delete')

                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                @endcan
            @endrole
        @else
            {{ $footer }}
        @endempty
    </div>
</div>