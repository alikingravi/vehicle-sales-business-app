<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'login']);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => (new BcryptHasher())->make($request->input('password')),
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'User has been created',
        ]);
    }

    public function login(Request $request)
    {
//        $this->validate($request, [
//            'email' => 'required|string|email|max:255',
//            'password' => 'required'
//        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Logged in successfully',
            'data' => Auth::user()
        ]);

    }
}
