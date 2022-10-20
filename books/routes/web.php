<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('book')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('book');
    Route::get('/detail/{id}', [BookController::class, 'detail'])->name('book.detail');
    Route::get('/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::patch('/update', [BookController::class, 'update'])->name('book.update');
    Route::get('/new', [BookController::class, 'new'])->name('book.new');
    Route::post('/create', [BookController::class, 'create'])->name('book.create');
    Route::delete('/remove/{id}', [BookController::class, 'remove'])->name('book.remove');
});

require __DIR__ . '/auth.php';
