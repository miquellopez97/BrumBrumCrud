<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    function login(){
        return view('user.login');
    }

    public function check(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:16'
        ]);
        $user = User::where('email', $request['email'])->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                if($user->rol == 'admin'){
                    $request->session()->put('LoggedUser', $user->id);
                    return redirect('profile');
                } else {
                    return back()->with('fail', 'No admin user');
                }
            } else {
                return back()->with('fail', 'No password found for this email');
            }
        }else {
            return back()->with('fail','No account found for this email');
        }
    }

    function profile(){
        if (session()->has('LoggedUser')){
            $user = User::where('id', session('LoggedUser'))->first();
        }
        return view('user.show', compact('user'));
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }
}
