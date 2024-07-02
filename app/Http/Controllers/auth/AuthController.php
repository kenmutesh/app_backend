<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //
    public function authenticate(LoginRequest $request): JsonResponse
    {
        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            return response()->json([
                'message' => 'Authentication successful',
                'user' => $user,
            ], 200);
        } else {
            // Authentication failed...
            return response()->json([
                'message' => 'Authentication failed. Invalid credentials.',
            ], 401);
        }
    }

    public function store(RegisterRequest $request): JsonResponse
    {

        // Create the user
        $user = User::create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
        ], 201);
    }

    public function reset(Request $request)
    {
        Log::info($request->email);

        return response()->json([
            'message' => 'Reset token sent to mail',
        ], 201);
    }
}
