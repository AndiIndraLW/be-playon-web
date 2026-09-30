<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Http\JsonResponse;

class HomepageSettingController extends Controller
{
    public function index(): JsonResponse
    {
        $setting = HomepageSetting::first();

        return response()->json([
            'data' => $setting,
        ]);
    }
}
