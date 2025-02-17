<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController; // Ini adalah pernyataan yang mengimpor (menggunakan) kelas PostController yang terletak dalam namespace App\Http\Controllers.//
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('posts', PostController::class)->middleware(['auth', 'verified']); // Ini menghasilkan berbagai rute standar yang diperlukan untuk mengelola posting, seperti rute untuk menampilkan, membuat, menyimpan, mengedit, dan menghapus posting.//
                                                // Middleware adalah filter yang digunakan untuk memproses permintaan sebelum mencapai tindakan yang sesuai di PostController. //      
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

