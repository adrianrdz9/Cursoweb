@extends('errors::illustrated-layout')

@section('title', __('No permitido'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'No permitido'))
