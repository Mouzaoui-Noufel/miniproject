<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AuthController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public routes
Route::get('/movies', [FilmController::class, 'index']);
Route::get('/movies/{id}', [FilmController::class, 'show']);
Route::get('/movies/{film}/reviews', [ReviewController::class, 'index']);
Route::get('/movies/{film}/rating', [RatingController::class, 'getFilmRating']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Movie management routes
    Route::post('/movies', [FilmController::class, 'store']);
    Route::put('/movies/{id}', [FilmController::class, 'update']);
    Route::delete('/movies/{id}', [FilmController::class, 'destroy']);

    // Rating routes
    Route::post('/movies/{film}/rate', [RatingController::class, 'store']);
    Route::delete('/movies/{film}/rate', [RatingController::class, 'destroy']);

    // Review routes
    Route::post('/movies/{film}/reviews', [ReviewController::class, 'store']);
    Route::put('/movies/{film}/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/movies/{film}/reviews/{review}', [ReviewController::class, 'destroy']);
    Route::get('/movies/{film}/user-review', [ReviewController::class, 'getUserReview']);

    // Favorite routes
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/movies/{film}/favorite', [FavoriteController::class, 'store']);
    Route::delete('/movies/{film}/favorite', [FavoriteController::class, 'destroy']);
    Route::get('/movies/{film}/favorite/check', [FavoriteController::class, 'check']);
});
