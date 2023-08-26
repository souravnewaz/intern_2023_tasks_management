<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        $status = request()->status;
        
        if($status == 'all') {
            $status = null;
        }

        $tasks = Task::query();

        if($role == 'user') {
            $tasks->where('user_id', auth()->user()->id);
        }

        if($status) {
            $tasks->where('status', $status);
        }

        $tasks = $tasks->with('user')->orderBy('id', 'DESC')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();

        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|min:4|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        Task::create($input);

        return redirect()->back()->with('success', 'Task assigned successfully');
    }

    public function start(Task $task)
    {
        $task->status = 'running';
        $task->save();

        return redirect()->back()->with('success', 'Task started!');
    }

    public function complete(Task $task)
    {
        $task->status = 'complete';
        $task->save();

        return redirect()->back()->with('success', 'Task completed successfully!');
    }
}