@extends('layouts.app')

@section('content')
@inject('carbon', '\Carbon\Carbon')

    <div class="container">
        <h1>Revisión de entrega de {{ $delivery->user->name }}</h1>
        <div class="card">
            <div class="card-header">
                <h3>
                    {{ $delivery->assignment->title }}
                </h3>
                <h4>
                    Entregado: {{ $delivery->updated_at->fromNow() }} ( {{ $delivery->updated_at->isoFormat('MMMM D YYYY, h:mm a') }} )
                </h4>
                <strong>
                    de {{ $delivery->user->name }}
                </strong>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                    Detalles de {{ $delivery->assignment->type }}
                                </h5>
                            </div>

                            <div class="card-body">
                                <p>
                                    <b>Título: </b>
                                    {{ $delivery->assignment->title }}
                                </p>

                                <p>
                                    <b>Fecha límite: </b>
                                    {{ $carbon->create($delivery->assignment->deadline)->isoFormat('MMMM D YYYY, h:mm a') }} ( {{ $carbon->create($delivery->assignment->deadline)->fromNow() }} )
                                </p>

                                <b>Descripción: </b>
                                {!! $delivery->assignment->description !!}
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <h5>Revisión</h5>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('delivery.update', ['id' => $delivery->id]) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="mark" id="mark">
                                    <div id="pmd-slider-step" class="pmd-range-slider pmd-range-tooltip"></div>
                                    <input class="btn btn-{{ isset($delivery->mark) ? 'info' : 'success' }}" type="submit" value=" {{ isset($delivery->mark) ? 'Actualzar calificación' : 'Calificar' }} ">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                    Detalles de la entrega
                                </h5>
                            </div>

                            <div class="card-body">
                                <p>
                                    <b>Entrega de: </b>
                                    {{ $delivery->user->name }} ( {{ $delivery->user->account_number }} )
                                </p>

                                <p>
                                    <b>Fecha de creación: </b>
                                    {{ $delivery->created_at->isoFormat('MMMM D YYYY, h:mm a') }}
                                </p>

                                <p>
                                    <b>Fecha de última actualización: </b>
				   <span class="{{ $delivery->updated_at > $carbon::create($delivery->assignment->deadline) ? 'text-danger' : 'text-success' }}">
                                    {{ $delivery->updated_at->isoFormat('MMMM D YYYY, h:mm a') }}
				    @if($delivery->updated_at > $carbon::create($delivery->assignment->deadline))
					- Fuera de fecha limite
				   @endif
				  </span>
                                </p>
                                
                                <p>
                                    <b>Link de entrega: </b>
                                    <a href="{{ $delivery->link }}">{{ $delivery->link }}</a>
                                </p>

                                <p>
                                    <b>Comentario: </b>
                                    {!! $delivery->comment !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

<style>
    @import "https://propeller.in/components/range-slider/css/nouislider.min.css";
    @import "https://propeller.in/components/range-slider/css/range-slider.css";
</style>

<script src="https://propeller.in/components/range-slider/js/wNumb.js"></script>
<script src="https://propeller.in/components/range-slider/js/nouislider.js"></script>
<script>
    function wait(){
        try{
            $(document).ready(()=>{
                // single range slider with step
                var pmdSliderStep = document.getElementById('pmd-slider-step');
                noUiSlider.create(pmdSliderStep, {
                    start: [ {{ isset($delivery->mark) ? $delivery->mark : 0 }} ],
                    connect: 'lower',
                    tooltips: [wNumb({ decimals: 0 }) ],
                    range: {
                        'min': [  0 ],
                        'max': [ 10 ]
                    },
                    step: 1,
                    pips: { // Show a scale with the slider
                        mode: 'steps',
                        density: 1
                    }
                });

                $('form').submit(()=>{
                    $('#mark').val(Math.round(pmdSliderStep.noUiSlider.get()));
                })
            });
        }catch(e){
            setTimeout(wait, 30);
        }
        
    }
    wait();
</script>
