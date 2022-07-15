@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" 
            href="{{ route('home') }}">back</a>
            post : {{ $posts->count() }}
        </div>
    </div>
</div>

@foreach ($posts as $post)

<div class="post_container">
    <div class="user_info">
        <img class="profile"
        src="{{ asset('storage/user/'.$post->user->profile) }}"/>
        <div class="username">
            {{ $post->user->username }}
        </div>
        <div class="go_to_profile_c">
            <a class="btn btn-primary"
            href="{{ route('user.show',$post->user) }}">visit profile</a>
        </div>
    </div>
    <img class="image"
    src="{{ asset('storage/post/'.$post->image) }}"/>
    <div class="caption">
        {{ $post->caption }}<br/>
        liked : 
        {{ $post->like }}
        <br/>
        <a class="btn btn-danger" 
            href="{{ route('post.like',$post) }}">like</a>
    </div>
</div>

@endforeach

@endsection
