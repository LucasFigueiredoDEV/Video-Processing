<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Hash;

class AuthService {
    public function register(array $data): array {
        if(User::where('email', $data['email'])->exists()) {
            throw new \Exception('Email already exists');
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(array $credentials): ?array
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }

        $user = Auth::user();

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }

    public function forgotPassword(array $data): void
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            throw new \Exception('User not found');
        }

        // Generate a password reset token
        $token = Password::broker()->createToken($user);

        // Send the reset password email
        Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
    }

    public function resetPassword(array $data): void
    {
        $status = Password::reset(
            [
                'email' => $data['email'],
                'token' => $data['token'],
                'password' => $data['password'],
                'password_confirmation' => $data['password_confirmation'],
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw new \Exception($this->getResetPasswordError($status));
        }
    }

    private function getResetPasswordError(string $status): string
    {
        return match ($status) {
            Password::INVALID_TOKEN => 'Invalid or expired token.',
            Password::INVALID_USER => 'User not found.',
            Password::RESET_THROTTLED => 'Please wait before requesting another reset.',
            default => 'Unable to reset password.',
        };
    }
}