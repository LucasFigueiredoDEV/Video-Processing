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
}