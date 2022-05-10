<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['only' => ['update', 'destroy']]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->all());

        return response()->json([
            "User" => $user,
            "token" => $user->createToken('brumbrumToken')->plainTextToken,
            201]);
    }

    public function show($id)
    {
        if (is_numeric($id)) {
            $user = User::where('id', $id)->first();
            return response()->json($user, 200);
        } else {
            $user = User::where('email', $id)->first();
            return response()->json($user, 200);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all())->save();
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->forceDelete();
        return response()->noContent();
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Credentials not match'], 401);
        }

        $user = User::where('email', $request['email'])->first();

        return response()->json([
            'User' => $user->id,
            'body' => $user,
            "token" => $user->createToken('brumbrumToken')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        $user = User::where('email', $request['email'])->first();

        $user->tokens()->delete();

        return response()->json([
            "status" => 1,
            "msg" => "Logout okeey",
        ]);
    }
}
