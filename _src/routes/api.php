<?php

use App\Http\Controllers\DealController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/health', [HealthController::class, 'check']);

Route::get('/', [HomeController::class, 'index']);

Route::apiResource('products', ProductController::class);

Route::apiResource('deals', DealController::class);
