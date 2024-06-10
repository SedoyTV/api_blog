<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request): JsonResponse
    {
        $data = $request->json()->all();
        $data['user_id'] = Auth::id();
        $post = Post::create($data);

        if (isset($data['category_ids'])) {
            $post->categories()->sync($data['category_ids']);
        }
        return response()->json($post->load('categories'));

    }

    public function show($id): JsonResponse
    {
        $message = 'Статья не найдена';
        $post = Post::with('categories')->find($id);

        if (is_null($post)) {
            return response()->json(['message' => $message]);
        } else {
            return response()->json($post);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $message = "Вы не являетесь автором этой статьи";
        $data = $request->json()->all();
        $data['user_id'] = Auth::id();
        $post = Post::with('categories')->where(
            'user_id', $request->user()->id)->find($id);
        if (!$post) {
            return response()->json(['message' => $message]);
        }
        $post->update($data);
        $post->categories()->sync($data['category_ids']);
        return response()->json($post->load('categories'));

    }

    public function destroy(string $id): JsonResponse
    {
        $message = 'Статья успешно удалена';
        $message2 = 'Статья не найдена или вы не являетесь автором статьи';
        $post = Post::where('user_id', Auth::id())->find($id);
        if ($post) {
            $post->delete();
            return response()->json(['message' => $message]);}
        else {
            return response()->json(['message' => $message2]);
        }
    }

    public function getUserPosts(Request $request): JsonResponse
    {
        $posts = Post::with('categories')->where(
            'user_id', $request->user()->id)->get();
        return response()->json($posts);
    }
}
