<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index():JsonResponse
    {
        return $this->postService->index();
    }

    public function store(Request $request): JsonResponse
    {
        return $this->postService->store($request);
    }

    public function show($id): JsonResponse
    {
        return $this->postService->show($id);
    }

    public function update(Request $request, $id): JsonResponse
    {
        return $this->postService->update($request, $id);
    }

    public function destroy(string $id): JsonResponse
    {
        return $this->postService->destroy($id);

    }
}

