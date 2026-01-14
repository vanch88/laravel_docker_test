<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        Log::info('API главная страница посещена');
        
        return response()->json([
            'status' => 'success',
            'message' => 'API',
            'version' => '1.0.0',
            'timestamp' => now()->toIso8601String(),
        ]);
    }
}
