@extends('layouts.app')
@section('title', 'Add User')

@section('content')

<form method="POST" class="col-5 shadow-sm border p-4" enctype="multipart/form-data">
    <h4>Add User</h4>
    @CSRF
    <div class="mb-3">
        <label class="form-label">Full name</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation">
    </div>
    <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image" />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

    @include('flash-message')
</form>


@endsection