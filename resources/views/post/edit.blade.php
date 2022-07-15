@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>edit post</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href=
            @if (auth()->user()->is_admin && !$post->user->is_admin)
                "{{ route('user.show',$post->user) }}"
            @else
                "{{ route('home') }}"
            @endif
            >back</a>
        </div>
    </div>
</div>
@include('layouts.partials.error')
<form action="{{ route('post.update',$post) }}" method="post"
enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-6">
            <strong>upload image : </strong>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>caption : </strong>
                <input type="text" class="form-control"
                placeholder="" name="caption"
                value="{{ $post->caption }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text_center">
            <button type="submit" class="btn btn-primary">
                submit
            </button>
        </div>
    </div>
</form>

@endsection