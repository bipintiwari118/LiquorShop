<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;

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
    Route::get('/user/register', [UserController::class, 'create'])->name('user.register');
    Route::post('/user/register', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




//Category route
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');
Route::get('/category/edit/{slug}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{slug}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/delete/{slug}', [CategoryController::class, 'delete'])->name('category.delete');

//Permission route
Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
Route::post('/permission/create', [PermissionController::class, 'store'])->name('permission.store');
Route::get('/permission/list', [PermissionController::class, 'list'])->name('permission.list');
Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
Route::post('/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
Route::get('/permission/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');


     // Products route start
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/store', [ProductController::class, 'storeProduct'])->name('product.store');
Route::get('/products/list', [ProductController::class, 'list'])->name('product.list');
Route::get('/products/delete/{slug}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/products/edit/{slug}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/products/edit/{slug}', [ProductController::class,'update'])->name('product.update');

});

require __DIR__.'/auth.php';
