@extends('layouts.app')
@section('title', 'Users')
@section('content')

<div class="d-flex justify-content-between">
    <h2>Users</h2>
    <div>
        <a href="/users/create" class="btn btn-primary btn-sm">Add User</a>
    </div>
</div>

<div class="row">
    @foreach ($users as $user)
        <div class="col-6 col-md-3 mb-2">
            <div class="card">
                <div class="card-body text-muted">
                    <center>
                        <img src="{{ isset($user->image) ? asset($user->image) : asset('assets/images/users/avatar_default.png') }}"
                                alt="img" height="48" width="48" class="rounded">
                        <h6 class="mx-2">{{ $user->name }}</h6>
                        <p>{{ $user->email }}</p>
                        <a href="/users/{{$user->id}}/edit" class="btn btn-dark btn-sm">Edit</a>
                    </center>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection