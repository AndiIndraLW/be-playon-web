<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->withCount(['posts' => function ($q) {
                $q->where('status', 'published');
            }])
            ->get();

        return response()->json([
            'data' => $categories,
        ]);
    }
}
