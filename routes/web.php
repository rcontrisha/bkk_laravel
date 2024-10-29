<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ControllerPendaftaran;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider, and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [AlumniController::class, 'dashboard'])->name('dashboard');
    Route::get('/filter-alumni', [AlumniController::class, 'filterAlumni'])->name('filter.alumni');

    // Route untuk bagian profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/input_data', [AlumniController::class, 'index'])->name('index.show');
    Route::post('/input_data', [AlumniController::class, 'store'])->name('index.store');

    // Route untuk Input Lowongan
    Route::get('/get_lowongan', [LowonganController::class, 'index'])->name('lowongan.show');
    Route::get('/lowongan', [LowonganController::class, 'data'])->name('lowongan.data');
    Route::post('/input_lowongan', [LowonganController::class, 'store'])->name('lowongan.store');
    Route::get('/edit-lowongan/{id}', [LowonganController::class, 'show'])->name('lowongan.edit');
    Route::put('/update-lowongan/{id}', [LowonganController::class, 'update'])->name('lowongan.update');

    Route::get('/data-alumni-tahun', [AlumniController::class, 'dataByYear'])->name('alumni.data.tahun');
    Route::get('/alumni/data', [AlumniController::class, 'getData'])->name('alumni.data');
    Route::get('/alumni', [AlumniController::class, 'show'])->name('alumni.index'); 
    Route::get('/edit-alumni/{id}', [AlumniController::class, 'edit'])->name('alumni.edit');
    Route::put('/update-alumni/{id}', [AlumniController::class, 'update'])->name('alumni.update');
    Route::delete('/alumni/data/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');
});

require __DIR__ . '/auth.php';
