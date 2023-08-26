@extends('layouts.app')
@section('title', 'Tasks')

@section('content')

<div class="d-flex justify-content-between">
    <h3>Tasks</h3>
    @if(auth()->user()->role == 'admin')
    <div>
        <a href="/tasks/create" class="btn btn-primary btn-sm">Add Task</a>
    </div>
    @endif
</div>

<div class="row px-2 mb-2">
    <div class="col-12 p-2 bg-light rounded">
        <div class="d-flex justify-content-end">
            <div>
                <form>
                    <div class="row align-items-center g-3">
                        <div class="col-auto">
                            <select name="status" class="form-select">
                                <option value="all" {{ request()->status == 'all' ? 'selected' : '' }}>All</option>
                                <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="running"  {{ request()->status == 'running' ? 'selected' : '' }}>Running</option>
                                <option value="complete" {{ request()->status == 'complete' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-dark">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @foreach ($tasks as $task)
        <div class="col-6 col-md-4 mb-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="text-muted small mb-0">{{ $task->created_at->format('Y-m-d h:ia') }}</p>
                    </div>
                    <div>
                        @if($task->status == 'pending')
                            <span class="badge text-bg-secondary">{{ $task->status }}</span>
                        @elseif($task->status == 'running')
                            <span class="badge text-bg-danger">{{ $task->status }}</span>
                        @elseif($task->status == 'complete')
                            <span class="badge text-bg-success">{{ $task->status }}</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <p>{{ $task->description }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <p class="mb-0">Assigned to: <strong>{{ $task->user->name }}</strong></p>
                    @if(auth()->user()->role == 'user')
                        @if($task->status == 'pending')
                            <a href="/tasks/{{$task->id}}/start" class="btn btn-success btn-sm">Start Task</a>
                        @endif
                        @if($task->status == 'running')
                            <a href="/tasks/{{$task->id}}/complete" class="btn btn-primary btn-sm">Mark as Complete</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection