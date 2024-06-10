<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public UserService  $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    public function register(Request $request): JsonResponse
    {
        return $this->userService->register($request);
    }

    public function login(Request $request): JsonResponse
    {
        return $this->userService->login($request);
    }

}
