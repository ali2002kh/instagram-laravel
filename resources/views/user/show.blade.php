@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href=
                    @if (auth()->user()->is_admin && !$user->is_admin)
                        "{{ route('user.index') }}"
                    @else
                        "{{ route('post.index') }}"
                    @endif
                    >back</a>
                </div>
            </div>
        </div>
        @if ($massage = Session::get('success')) 
        <div class="alert alert-success">
            <p>
                {{ $massage }} 
            </p>
        </div>
        @endif

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
                src="{{ asset('storage/user/'.$post->user->profile) }}"/>
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

        @if(auth()->user()->is_admin || $user->id == auth()->user()->id)
            <form action="{{ route('post.destroy',$post) }}" method="POST">
                {{-- <a class="btn btn-primary" 
                href="{{ route('post.edit',$post) }}">edit</a> --}}
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    delete
                </button>
            </form>
        @endif

        </div>

        @endforeach
        
        @endsection