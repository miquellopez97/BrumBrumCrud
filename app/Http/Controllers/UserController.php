<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['only' => ['index','show','update', 'destroy']]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $request->merge([
            'password' => Hash::make($request['password']),
            'rol' => "user"
        ]);
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

    public function userLab($id)
    {
        $user = User::where('id', $id)->first();
        $value = [
            "username" => $user -> username,
            "name" => $user -> name,
            "surname" => $user -> surname,
        ];
        return response()->json($value, 200);
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
        $request->headers->set('Accept', 'application/json');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5|max:16',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Bad email / password form'], 401);
        }

        $credentials = $validator->validated();

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
