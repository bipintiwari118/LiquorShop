<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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
    return view('frontend.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




//Category route
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');


     // Products route start
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/store', [ProductController::class, 'storeProduct'])->name('product.store');
Route::get('/products/list', [ProductController::class, 'list'])->name('product.list');
// Route::get('/products/delete/{slug}', [ProductController::class, 'deleteProduct'])->name('admin.delete.product');
// Route::get('/products/edit/{slug}', [ProductController::class, 'editProduct'])->name('admin.edit.product');
// Route::post('/products/edit/{id}', [ProductController::class, 'updateProduct'])->name('admin.update.product');

});

require __DIR__.'/auth.php';
