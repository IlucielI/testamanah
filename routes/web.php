<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PagesController;
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
  Route::get('/', [PagesController::class,'index'])->name('home');
  Route::get('/products', [PagesController::class,'products']);

Route::group(['middleware' => ['checkRole:admin', 'auth']], function () {
  Route::get('/admin', [PagesController::class,'admin_dashboard']);
  Route::get('/admin/products', [ProductController::class,'index']);
  Route::get('/admin/addProduct', [ProductController::class, 'create']);
  Route::post('/admin/addProduct', [ProductController::class, 'store']);
  Route::get('/admin/editProduct/{id}', [ProductController::class, 'edit']);
  Route::post('/admin/editProduct/{id}', [ProductController::class, 'update']);
  Route::get('/admin/detailProduct/{id}', [ProductController::class, 'show']);
  Route::post('/admin/deleteProduct', [ProductController::class, 'destroy']);
  Route::get('/admin/miniGame', [PagesController::class,'miniGame']);
});
Auth::routes();
