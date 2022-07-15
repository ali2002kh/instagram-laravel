@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>edit profile</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href=
            @if (auth()->user()->is_admin && !$user->is_admin)
                "{{ route('user.index') }}"
            @else
                "{{ route('home') }}"
            @endif
            >back</a>
        </div>
    </div>
</div>
@include('layouts.partials.error')
<form action="{{ route('user.update',$user) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>name : </strong>
                <input type="text" class="form-control"
                placeholder="" name="name"
                value="{{ $user->name }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>username : </strong>
                <input type="text" class="form-control"
                placeholder="" name="username"
                value="{{ $user->username }}">
            </div>
        </div>
        <div class="col-md-6">
            <strong>upload image : </strong>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>bio : </strong>
                <input type="text" class="form-control"
                placeholder="" name="bio"
                value="{{ $user->bio }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>email : </strong>
                <input type="email" class="form-control"
                placeholder="" name="email"
                value="{{ $user->email }}">
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