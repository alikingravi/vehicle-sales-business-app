<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'login']);
    }

    /**
     * Registers a user and creates an account balance for them
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

        if (count($user) > 0) {
            $account = Account::create([
                'user_id' => $user->id,
                'total_profit_made' => 0,
                'total_cash_invested' => 0,
                'my_profit' => 0,
                'revenue' => 0
            ]);
        }

        return response()->json([
            'user' => $user,
            'account' => $account,
            'message' => 'User and his account balance has been created'
        ]);
    }

    /**
     * Logs in the user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        return response()->json([
            'status' => 200,
            'message' => 'Logged in successfully',
            'data' => Auth::user()
        ]);
    }
}
