<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Middleware\EnsureJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware([EnsureJsonResponse::class])->group(function () {
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::post('/reset', [AuthController::class, 'reset']);
    }
);
