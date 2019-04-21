@extends('layouts.app')

@section('content')
    @inject('carbon', '\Carbon\Carbon')
    
    <div class="text-center">
        <span>
            Hoy es: 
            {{ $today }}

        </span>
    </div>
    <calendar-component :assignments="{{ $assignments }}"></calendar-component>

@endsection