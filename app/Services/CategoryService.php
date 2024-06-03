<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryService
{
    public function index(): JsonResponse {
        $categories = Category::all();
        $message = 'Категории не добавлены';
        if ($categories->isEmpty()) {
            return response()->json(['message' => $message]);
        } else {
            return response()->json($categories);
        }
    }
    public function store($request): JsonResponse {
        $data = $request->json()->all();
        $categories = Category::create($data);
        return response()->json($categories);
    }
    public function show($id): JsonResponse {
        $categories = Category::find($id);
        $message = "Категория с id=$id не найдена";
        if (!$categories) {
            return response()->json(['message' => $message]);
        } else {
            return response()->json($categories);
        }
    }
    public function update($request, $id): JsonResponse {
        $data = $request->json()->all();
        $categories = Category::find($id);
        $message = "Категория с id=$id не найдена";
        if (!$categories) {
            return response()->json(['message' => $message]);
        } else {
            $categories->update($data);
            return response()->json($categories);
        }
    }
    public function destroy($id): JsonResponse {
        $categories = Category::find($id);
        if (!$categories) {
            return response()->json(['message' => 'Категории с id=$id не существует']);
        }
        else {
            $categories->delete();
            return response()->json($categories);
        }
    }
}
