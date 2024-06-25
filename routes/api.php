<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('user/register', [UserController::class, 'register'])->name('register');
Route::post('user/login', [UserController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->get('user/posts', [PostController::class, 'getUserPosts']);

Route::get('posts', [PostController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {

    Route::get('posts/{id}', [PostController::class, 'show']);
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);

    Route::apiResource('categories', CategoryController::class);
});

