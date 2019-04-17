@extends('layouts.app')

@section('content')
@inject('carbon', '\Carbon\Carbon')


<div class="container mt-1">
    <div class="row">
        <div class="col-md-9 offset-md-2">
            <h4>Entregas</h4>
            <ul class="timeline">
                @foreach ($deliveries as $delivery)
                    <li>
                        {{ $delivery->assignment->type }}:
                        <a target="_blank" href="{{ route('assignment.show', ['id'=>$delivery->assignment->id]) }}"> {{ $delivery->assignment->title }} <i class="fas fa-external-link-alt ml-1"></i></a>
                        <a href="{{ route('delivery.show', ['assignment_id' => $delivery->assignment->id]) }}" class="float-right">Ver ultima entrega ({{$delivery->updated_at->isoFormat('MMMM D YYYY, h:mm a') }}) <i class="fas fa-external-link-alt ml-1"></i></a>
                        <div style="max-height: 200px; overflow-x: scroll;">
                            <p>
                                <strong>Tu entrega:</strong><br>
                                <a href="{{ $delivery->link }}">{{ $delivery->link}}</a>
                                {!! $delivery->comment !!}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
    
@endsection