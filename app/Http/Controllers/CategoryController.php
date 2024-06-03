<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public CategoryService  $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(): JsonResponse
    {
        return $this->categoryService->index();
    }
    public function store(Request $request): JsonResponse
    {
        return $this->categoryService->store($request);
    }
    public function show($id): JsonResponse
    {
        return $this->categoryService->show($id);
    }
    public function update(Request $request, $id): JsonResponse
    {
        return $this->categoryService->update($request, $id);
    }
    public function destroy($id): JsonResponse
    {
        return $this->categoryService->destroy($id);
    }
}
