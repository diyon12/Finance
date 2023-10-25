<?php

use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/finance', [FinanceController::class, 'index_finance'])->name('finance');
    Route::post('/store_finance', [FinanceController::class, 'store_finance'])->name('store_finance');
    
    Route::get('/buku', [FinanceController::class, 'buku'])->name('buku');
    Route::post('/store_buku', [FinanceController::class, 'store_buku'])->name('store_buku');
    Route::get('/detail_buku/{id}', [FinanceController::class, 'detail_buku'])->name('detail_buku');
    // Route::get('/hapus', [FinanceController::class, 'hapus'])->name('hapus');
    Route::delete('/hapusData/{id}', [FinanceController::class, 'hapusData'])->name('hapusData');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
