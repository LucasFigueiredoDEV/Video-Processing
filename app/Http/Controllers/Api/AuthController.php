<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function register(Request $request, AuthService $service)
    {
        try {
            $data = $service->register(
                $request->only('name', 'email', 'password')
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'user' => $data['user'],
            'token' => $data['token'],
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(Request $request, AuthService $service)
    {
        $data = $service->login(
            $request->only('email', 'password')
        );

        if (!$data) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'token' => $data['token'],
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request, AuthService $service)
    {
        $service->logout($request->user());

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function forgotPassword(Request $request, AuthService $service)
    {
        try {
            $service->forgotPassword($request->only('email'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'message' => 'Password reset link sent to your email.'
        ]);
    }

    public function resetPassword(Request $request, AuthService $service)
    {
        $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            $service->resetPassword(
                $request->only('token', 'email', 'password', 'password_confirmation')
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'message' => 'Password has been reset successfully.'
        ]);
    }
}