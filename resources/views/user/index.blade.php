@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="pull-right">
                <a class="btn btn-primary" 
                href="{{ route('home') }}">back</a>
                <a class="btn btn-info" href="{{ route('user.create') }}">
                    add user
                </a>
            </div>
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
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>profile image</th>
        <th>name</th>
        <th>username</th>
        <th>posts</th>
        <th>bio</th>
        <th>email</th>
        <th>option</th>
    </tr>

    @foreach ($users as $user)

    <tr>
        <td>
            <img class="profile"
            src="{{ asset('storage/user/'.$user->profile) }}"/>
        </td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->numberOfPosts() }}</td>
        <td>{{ $user->bio }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <form action="{{ route('user.destroy',$user) }}" method="POST">
                <a class="btn btn-info"
                href="{{ route('user.show',$user) }}">show</a>
                <a class="btn btn-primary" 
                href="{{ route('user.edit',$user) }}">edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    delete
                </button>
            </form>
        </td>
    </tr>

    @endforeach

</table>

@endsection
