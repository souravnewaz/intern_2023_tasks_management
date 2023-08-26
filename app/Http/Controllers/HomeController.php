<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['users'] = User::where('role', 'user')->count();
        $data['total_tasks'] = Task::count();
        $data['completed_tasks'] = Task::where('status', 'complete')->count();

        return view('home', compact('data'));
    }
}
