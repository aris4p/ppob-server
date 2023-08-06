<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DigiflazzController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VipresellerController;
use App\Http\Controllers\Payment\TripayCallbackController;

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

Route::get('/', [ClientController::class, 'index'])->name('home');

Route::get('/produk/{id}', [ClientController::class, 'produk']);


Route::get('/pulsa/{kode}', [VipresellerController::class, 'pulsa']);
Route::post('/pembayaran/pulsa', [VipresellerController::class, 'payment'])->name('payment');


Route::get('/produk/{id}', [ClientController::class, 'produk']);
Route::get('/cek-invoice', [ClientController::class, 'cek_invoice'])->name('cek-invoice');
Route::get('/invoice', [ClientController::class, 'invoice'])->name('invoice');
Route::post('/pembayaran', [ClientController::class, 'pembayaran'])->name('pembayaran');
Route::get('/pembayaran/proses', [ClientController::class, 'proses'])->name('proses');



Route::group(['prefix' => 'admin','middleware' => 'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/tambah', [ProductController::class, 'create'])->name('tambah-product');
    Route::post('/product/tambah', [ProductController::class, 'store'])->name('proses-tambah-product');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('proses-edit-product');
    Route::post('/product/edit/{id}', [ProductController::class, 'update'])->name('proses-update-product');
    Route::post('/deleteproduct', [ProductController::class, 'delete'])->name('delete-product');
    Route::resource('product-control', ProductController::class, ['except' => [
        'create','show','destroy'
        ]]);
        // Route::post('/product/edit/{id}', [ProductController::class, 'simpanProduk'])->name('update-product');
        
    // transaction
    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');
    });

    
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
    

    