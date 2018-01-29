<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'checkAuthUser']);
    }

    public function checkAuthUser()
    {
        $user = Auth::user();

        if (!isset($user)) {
            return response()->json([
                'status' => 404,
                'message' => 'User not logged-in'
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'User logged-in',
            'data' => $user
        ]);
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

        if ($user) {
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
     * @internal param Request $request
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!empty($user)) {
            if ((new BcryptHasher())->check($request->input('password'), $user->password)) {
                $apiToken = base64_encode(str_random(40));

                User::where('email', $request->input('email'))->update([
                    'api_token' => $apiToken
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Logged in successfully',
                    'data' => $user,
                    'api_token' => $apiToken
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Unauthorized'
                ]);
            }
        }
    }
}
