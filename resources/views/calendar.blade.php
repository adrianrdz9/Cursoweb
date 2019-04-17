@extends('layouts.app')

@section('content')
    
    <calendar-component :assignments="{{ $assignments }}"></calendar-component>

@endsection