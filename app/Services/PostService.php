<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostService
{
    public function index(): JsonResponse
    {
        $posts = Post::with('categories')->get();
        $message = 'К сожалению статей нет';

        if ($posts->isEmpty()) {
            return response()->json(['message' => $message]);
        } else {
            return response()->json($posts);
        }
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();
        $posts = Post::create($data);

        if (isset($data['category_ids'])) {
            $posts->categories()->sync($data['category_ids']);
        }
        return response()->json($posts->load('categories'));

    }

    public function show($id): JsonResponse
    {
        $message = 'Статья не найдена';
        $posts = Post::with('categories')->find($id);

        if (is_null($posts)) {
            return response()->json(['message' => $message]);
        } else {
            return response()->json($posts);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->json()->all();
        $posts = Post::with('categories')->find($id);
        $posts->update($data);
        $posts->categories()->sync($data['category_ids']);

        return response()->json($posts->load('categories'));
    }

    public function destroy(string $id): JsonResponse
    {
        $message = 'Статья успешно удалена';
        $message2 = 'Статья не найдена';
        $posts = Post::find($id);

        if ($posts) {
            $posts->delete();
            return response()->json(['message' => $message]);}
        else {
            return response()->json(['message' => $message2]);
        }
    }
}
