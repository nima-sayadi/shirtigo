<?php

use App\Http\Controllers\CockpitApiController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [CockpitApiController::class, 'getProducts'])->name('orders');

// API routes for predictions and placing orders
Route::post('api/predict-price', [CockpitApiController::class, 'predictPrice']);
Route::post('api/place-order', [CockpitApiController::class, 'placeOrder']);

// REMOVE THE BELOW LINE
Route::get('/test', [CockpitApiController::class, 'getProducts']);