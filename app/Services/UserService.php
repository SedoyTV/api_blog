<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function register($request): JsonResponse
    {
        {
            $message = "Пользователь с таким email уже существует";
            $current_user = User::where('email', $request['email'])->first();
            if ($current_user) {
                return response()->json(['message' => $message]);
            }
            $user = User::create($request->all());
            $token = $user->createToken('Token')->plainTextToken;

            return response()->json(['token' => $token]);

        }
    }
    public function login($request): JsonResponse
    {
        {
            $message = 'Неверный email или пароль';
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json(['message' => $message]);
            }

            $user = Auth::user();
            $token = $user->createToken('Token')->plainTextToken;

            return response()->json(['token' => $token]);

        }
    }
}
