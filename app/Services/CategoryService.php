<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryService
{
    public function index(): JsonResponse
    {
        $categories = Category::all();
        $message = 'Категории не добавлены';
        if ($categories->isEmpty()) {
            return response()->json(['message' => $message]);
        } else {
            return response()->json($categories);
        }
    }
    public function store($request): JsonResponse
    {
        $data = $request->json()->all();
        $category = Category::create($data);
        return response()->json($category);
    }
    public function show($id): JsonResponse
    {
        $category = Category::find($id);
        $message = "Категория с id=$id не найдена";
        if (!$category) {
            return response()->json(['message' => $message]);
        } else {
            return response()->json($category);
        }
    }
    public function update($request, $id): JsonResponse
    {
        $data = $request->json()->all();
        $category = Category::find($id);
        $message = "Категория с id=$id не найдена";
        if (!$category) {
            return response()->json(['message' => $message]);
        } else {
            $category->update($data);
            return response()->json($category);
        }
    }
    public function destroy($id): JsonResponse
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Категории с id=$id не существует']);
        }
        else {
            $category->delete();
            return response()->json($category);
        }
    }
}
