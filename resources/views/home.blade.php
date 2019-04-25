@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>
            Avisos
        </h1>  
        
        <div class="row">
            @foreach ($announcements as $announcement)
                <div class="col-md-6 col-sm-12">
                    <div class="card mt-2">
                        <div class="card-header bg-info">
                            <h3>{{ $announcement->title }}</h3>
                        </div>

                        <div class="card-body">
                            {!! $announcement->description !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
