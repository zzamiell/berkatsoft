<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperController;

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

Route::get('/', [SuperController::class, 'index'])->name('/');
Route::get('/logout', [SuperController::class, 'logout'])->name('logout');
Route::post('/masuk', [SuperController::class, 'masuk'])->name('masuk');

Route::get('/customer', [SuperController::class, 'list_customer'])->name('customer');
Route::post('/insert_customer', [SuperController::class, 'insert_customer'])->name('insert_customer');
Route::post('/edit_customer/{id}', [SuperController::class, 'edit_customer'])->name('edit_customer');
Route::post('/hapus_customer/{id}', [SuperController::class, 'hapus_customer'])->name('hapus_customer');

Route::get('/produk', [SuperController::class, 'list_produk'])->name('produk');
Route::post('/insert_produk', [SuperController::class, 'insert_produk'])->name('insert_produk');
Route::post('/edit_produk/{id}', [SuperController::class, 'edit_produk'])->name('edit_produk');
Route::post('/hapus_produk/{id}', [SuperController::class, 'hapus_produk'])->name('hapus_produk');


Route::get('/order', [SuperController::class, 'list_order'])->name('order');
Route::post('/insert_order', [SuperController::class, 'insert_order'])->name('insert_order');
Route::post('/edit_order/{id}', [SuperController::class, 'edit_order'])->name('edit_order');
Route::post('/hapus_order/{id}', [SuperController::class, 'hapus_order'])->name('hapus_order');
