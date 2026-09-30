<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index(): JsonResponse
    {
        $articles = Article::latest('published_at')->get();

        return response()->json([
            'data' => $articles,
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return response()->json([
            'data' => $article,
        ]);
    }
}
