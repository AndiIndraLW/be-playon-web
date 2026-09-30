<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Post::query()
            ->with(['category:id,name,slug', 'author:id,name'])
            ->where('status', 'published');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->query('category'));
            });
        }

        $posts = $query->latest('published_at')->paginate($request->integer('per_page', 10));

        return response()->json($posts);
    }

    public function show(string $slug): JsonResponse
    {
        $post = Post::query()
            ->with(['category:id,name,slug', 'author:id,name'])
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'data' => $post,
        ]);
    }
}
