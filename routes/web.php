<?php

use App\Http\Controllers\CockpitApiController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [CockpitApiController::class, 'getProducts'])->name('orders');

// API routes for predictions and placing orders | typical Axios is used for the below paths | Could also used API middleware
Route::post('api/predict-price', [CockpitApiController::class, 'calculatePrice']);
Route::post('api/place-order', [CockpitApiController::class, 'createOrder']);