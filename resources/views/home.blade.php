@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                @if ($massage = Session::get('success')) 
                <div class="alert alert-success">
                    <p>
                        {{ $massage }} 
                    </p>
                </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-danger" href="{{ route('post.create') }}">
                        add post
                    </a>
                    @if (!$user->is_admin)
                    <a class="btn btn-danger" href="{{ route('post.index') }}">
                        explore
                    </a>     
                    @endif     
                </div>
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('user.edit',$user) }}">
                        edit profile
                    </a>        
                    @if ($user->is_admin)
                    <a class="btn btn-danger" href="{{ route('user.index') }}">
                        administer
                    </a>  
                    @endif
                </div>
                <div class="" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <header>
                    <div class="user_info">
                        <img class="profile"
                        src="{{ asset('storage/user/'.$user->profile) }}"/>
                        <div class="username">
                            {{ $user->username }}
                        </div>
                    </div>
                    <div class="caption">
                        {{ $user->bio }} <br/>
                        posts : {{ $user->numberOfPosts() }}
                    </div>
                </header>
        
                @foreach ($user->posts as $post)
        
                <div class="post_container">
                    <div class="user_info">
                        <img class="profile"
                        src="{{ asset('storage/user/'.$user->profile) }}"/>
                        <div class="username">
                            {{ $post->user->username }}
                        </div>
                        <div class="go_to_profile_c">
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
                    <form action="{{ route('post.destroy',$post) }}" method="POST">
                        <a class="btn btn-primary" 
                        href="{{ route('post.edit',$post) }}">edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            delete
                        </button>
                    </form>
                </div>
        
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
