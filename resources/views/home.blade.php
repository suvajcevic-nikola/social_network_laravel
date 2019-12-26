@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <form action="/home" method="post">
                        @csrf
                        <textarea name="content" rows="5" cols="30"
                                  class="form-control"
                                  placeholder="What is on your mind...">
                        </textarea>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Post!">
                    </form>
                </div>
                <hr>
                <div class="card-body">
                    @foreach($posts as $post)
                        <h5>
                            @if (file_exists(public_path().'/images/'.$post->id. '.png'))
                                <img src="{{ asset('images/'.$post->id) }}.png" width="20%">
                            @else
                                <img src="{{ asset('images/def.png') }} " width="20%">
                            @endif

                            <a href="user/{{ $post->user_id }}">{{ $post->user->name }} ({{ $post->user->email }})</a>
                        </h5>
                        @if($post->user->id == Auth::user()->id)
                            <p style="color: green">{{ $post->content }}</p>
                        @else
                            <p style="color: blue">{{ $post->content }}</p>
                        @endif
                        <small>{{ $post->created_at->format("d.m.Y.") }}</small>
                        <small>{{ $post->updated_at->diffForHumans() }}</small>
                        <hr>
                    @endforeach
                </div>
                    <div class="card">
                        <div class="card-header">
                            Events
                        </div>
                        <div class="card-body">
                            @foreach($events as $event)
                                <a href="event/{{ $event->id }}">{{ $event->name }}</a>
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>

        <div class="col-md-4">
            @if(count($mutuals))
                <div class="card">
                    <div class="card-header">
                        Mutual friends
                    </div>
                    <div class="card-body">
                        @foreach($mutuals as $follow)
                            <h5><a href="user/{{ $follow->id }}">{{ $follow->name }}</a></h5>
                        @endforeach
                    </div>
                </div>
            @endif
            <br>
            @if(count($following))
                <div class="card">
                    <div class="card-header">
                        Users I'm following
                    </div>
                    <div class="card-body">
                        @foreach($following as $follow)
                            <h5><a href="user/{{ $follow->id }}">{{ $follow->name }}</a></h5>
                        @endforeach
                    </div>
                </div>
            @endif
            <br>
                @if(count($followers))
                    <div class="card">
                        <div class="card-header">
                            My followers
                        </div>
                        <div class="card-body">
                            @foreach($followers as $follow)
                                <h5><a href="user/{{ $follow->id }}">{{ $follow->name }}</a></h5>
                            @endforeach
                        </div>
                    </div>
                @endif
                <br>
                @if(count($others))
                    <div class="card">
                        <div class="card-header">
                            Suggestions
                        </div>
                        <div class="card-body">
                            @foreach($others as $follow)
                                <h5><a href="user/{{ $follow->id }}">{{ $follow->name }}</a></h5>
                            @endforeach
                        </div>
                    </div>
                @endif
        </div>
    </div>
</div>
@endsection
