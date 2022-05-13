<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ViewsController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }


    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
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


    public function loginView(Request $request)
    {
        return view('user.login');
    }

    public function check(Request $request)
    {
        return $request->input();
        // $request->validate([
        //     'email',
        //     'password'
        // ]);

        // $user = User::where('email','=',$request->email)->firts();
        // if($user){
        //     if(Hash::check($request->password, $user->password)){
        //         $request->session()->put('LoggedUser', $user->$id);
        //         return redirect('index');
        //     }
        // }
    }
}
