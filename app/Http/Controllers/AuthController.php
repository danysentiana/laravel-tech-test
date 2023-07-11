<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // validation
        // $validatedData = $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|min:6|max:20',
        // ]);

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validatedData->errors(),
            ], 422);
        }

        // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(
            ['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login credentials'
            ], 401);
        }

        $token = Auth::user()->createToken('auth_token')->accessToken;

        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'access_token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ], 200);
    }
}
