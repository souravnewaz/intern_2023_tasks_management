@extends('layouts.app')
@section('title', 'Home')

@section('content')

<h1>Welcome Admin</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card border border-success">
            <div class="card-body">
                <small>Total Users</small>
                <h3>{{ $data['users'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border border-info">
            <div class="card-body">
                <small>Total Tasks</small>
                <h3>{{ $data['total_tasks'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border border-primary">
            <div class="card-body">
                <small>Completed Tasks</small>
                <h3>{{ $data['completed_tasks'] }}</h3>
            </div>
        </div>
    </div>
</div>

@endsection