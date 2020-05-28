<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['Error message' => 'Invalid email or password.'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function respondWithToken($token)
    {
        return response()->json([

            'token'          => $token,
            'accept_type'    => 'bearer',
            'expires_in'     => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['Message' => 'User successfully logged out'], 200);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|min:3|max:100',
            'email'      => 'required|max:255|min:9|unique:users',
            'password'   => 'required|min:6|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = \App\User::create([
            'name'       => $request->input('name'),
            'email'      => $request->input('email'),
            'password'   => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'message'    => 'Registration was successful.',
            'user'       => $user
        ], 201);
    }
}
