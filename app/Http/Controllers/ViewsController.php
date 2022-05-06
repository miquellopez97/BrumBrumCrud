<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ViewsController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'password' => 'required',
            'rol',
            'detail',
            'otherInformation',
            'photo',
            'googleID'
        ]);

        $request['password'] = Hash::make($request['password']);
        BbUsers::create($request->all());

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, BbUsers $user)
    {
        $request->validate([
            'name',
            'surname',
            'password',
            'rol',
            'detail',
            'otherInformation',
            'photo'
        ]);

        $user->update($request->all());

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
