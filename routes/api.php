
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookmarkController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rute untuk login API
Route::post('/login', [AuthenticatedSessionController::class, 'apiStore']);
Route::post('/register', [RegisteredUserController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // Routes untuk LowonganController
    Route::get('/lowongan', [LowonganController::class, 'index']);
    Route::get('/lowongan/{id}', [LowonganController::class, 'show']);
    Route::post('/lowongan', [LowonganController::class, 'store']);
    Route::put('/lowongan/{id}', [LowonganController::class, 'update']);
    Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy']);

    // Routes untuk AlumniController
    Route::get('/alumni', [AlumniController::class, 'index']);
    Route::get('/data-alumni', [AlumniController::class, 'show']);
    Route::post('/alumni', [AlumniController::class, 'store']);
    Route::put('/alumni', [AlumniController::class, 'update']);
    Route::delete('/alumni/{id}', [AlumniController::class, 'destroy']);
    Route::post('/alumni/update-photo', [AlumniController::class, 'updatePhoto']);

    // Routes untuk Bookmark Jobs
    Route::post('/bookmarks', [BookmarkController::class, 'store']); // Add a bookmark
    Route::delete('/bookmarks/{job_id}', [BookmarkController::class, 'destroy']); // Remove a bookmark
    Route::get('/bookmarks', [BookmarkController::class, 'index']); // List all bookmarks
});

// Rute untuk logout API
Route::middleware('auth:sanctum')->post('/logout', [AuthenticatedSessionController::class, 'destroy']);
