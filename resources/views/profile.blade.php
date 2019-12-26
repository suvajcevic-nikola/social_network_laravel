@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
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
                        <p>{{ $post->content }}</p>
                        <small>{{ $post->created_at->format("d.m.Y.") }}</small>
                        <small>{{ $post->updated_at->diffForHumans() }}</small>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
