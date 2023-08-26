<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->orderBy('id', 'DESC')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|max:100|min:3',
            'email' => 'required|email|unique:users,email',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $path = 'assets/images/users/';
        $request->image->move(public_path($path), $imageName);

        $input['role'] = 'user';
        $input['image'] = $path.$imageName;
        $input['password'] = Hash::make($request->password);

        User::create($input);

        return redirect()->back()->with('success', 'User added successfuly');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|max:100|min:3',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if($request->hasFile('image')) {
            
            $imageName = time().'.'.$request->image->extension();
            $path = 'assets/images/users/';
            $request->image->move(public_path($path), $imageName);
            $input['image'] = $path.$imageName;

            if($user->image != null) {
                unlink(public_path($user->image));
            }
        }

        if($request->has('password')) {
            $input['password'] = Hash::make($request->password);
        }

        $user->update($input);

        return redirect()->back()->with('success', 'User updated successfuly');
    }
}
