@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Events</div>
                        <div class="card-body">
                            <p>{{ $event->name }}</p>
                            <p>{{ $event->location }}</p>
                            <p>{{ $event->date }}</p>
                            <p>{{ $event->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
