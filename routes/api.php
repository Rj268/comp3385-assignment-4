<?php

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/v1/movies', [MovieController::class, 'index']);
Route::post('/v1/movies', [MovieController::class, 'store']);

Route::post('v1/login', [AuthController::class, 'login']);
Route::post('v1/register', [AuthController::class, 'logout']);
