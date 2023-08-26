@extends('layouts.app')
@section('title', 'Add Task')

@section('content')

<form method="POST" class="col-5 shadow-sm border p-4">
    <h3>Add Task</h3>
    @CSRF

    <div class="mb-3">
        <label>Seelct User</label>
        <select class="form-select" name="user_id">
            <option selected disabled>Select User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>                
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Task Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

    @include('flash-message')
</form>

@endsection