<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripePaymentController;


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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','role:Super-Admin|Admin|Sub-Admin'])->group(function () {
    Route::get('/dashboard',[HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('about', 'about')->name('about');

    Route::group(['middleware' => ['role:Super-Admin']], function () {
        Route::get('/user/register', [UserController::class, 'create'])->name('user.register');
        Route::post('/user/register', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('users', [UserController::class, 'index'])->name('users.index');


        //Permission route
        Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('/permission/create', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('/permission/list', [PermissionController::class, 'list'])->name('permission.list');
        Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
        Route::get('/permission/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');

        //Role route
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role/create', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role/list', [RoleController::class, 'list'])->name('role.list');
        Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
        Route::get('/role/permission/{id}', [RoleController::class, 'addPermissionToRole'])->name('role.permission');
        Route::post('/role/permission/store/{id}', [RoleController::class, 'storePermissionToRole'])->name('update.role.permission');

    });


      Route::group(['middleware' => ['role:Admin']], function () {
        //Category route
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');
        Route::get('/category/edit/{slug}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update/{slug}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/delete/{slug}', [CategoryController::class, 'delete'])->name('category.delete');

        });


     // Products route start
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products/store', [ProductController::class, 'storeProduct'])->name('product.store');
    Route::get('/products/list', [ProductController::class, 'list'])->name('product.list');
    Route::get('/products/delete/{slug}', [ProductController::class, 'delete'])->name('product.delete')
    ->middleware('permission:Delete Product');
    Route::get('/products/edit/{slug}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/products/edit/{slug}', [ProductController::class,'update'])->name('product.update');





    //order route
      Route::get('/order/list', [OrderController::class, 'orderList'])->name('order.list');
      Route::get('/orders/edit/{id}', [OrderController::class, 'orderEdit'])->name('order.edit');
      Route::get('/orders/edit/{id}', [OrderController::class, 'orderEdit'])->name('order.edit');
      Route::get('/orders/view/{id}', [OrderController::class,'orderView'])->name('order.view');
      Route::get('/complete/order/list', [OrderController::class, 'completedOrders'])->name('complete.order.list');
      Route::get('/orders/delete/{id}', [OrderController::class, 'orderDelete'])->name('order.delete');
      Route::post('/orders/update/{id}', [OrderController::class,'orderUpdate'])->name('order.update');










});

require __DIR__.'/auth.php';



//frontend route



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact-submit', [HomeController::class, 'submitForm'])->name('contact.submit');
Route::get('/beer', [HomeController::class, 'beerShow'])->name('beer.show');
Route::get('/rum', [HomeController::class, 'rumShow'])->name('rum.show');
Route::get('/vodka', [HomeController::class, 'vodkaShow'])->name('vodka.show');
Route::get('/soft-drink', [HomeController::class, 'softDrinkShow'])->name('softDrink.show');
Route::get('/cigratte', [HomeController::class, 'cigratteShow'])->name('cigratte.show');
Route::get('snack', [HomeController::class, 'snackShow'])->name('snack.show');
Route::get('/product/details/{slug}', [HomeController::class, 'productDetails'])->name('product.details');


//carts route

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/{id}', [CartController::class, 'addCart'])->name('addToCart');
Route::get('/cart/remove/{id}',[CartController::class, 'cartRemove'])->name('cart.remove');
Route::post('/cart/update-ajax/{id}', [CartController::class, 'updateAjax']);
Route::get('/clear',[CartController::class, 'cartClear'])->name('cart.clear');

//checkout through qr
Route::get('/payment/checkout',[OrderController::class, 'createQr'])->name('check.out.qr');


//checkout routes

Route::get('/checkout',[OrderController::class, 'create'])->name('check.out');
Route::post('/checkout',[OrderController::class,'store'])->name('checkout.store');


Route::controller(StripePaymentController::class)->group(function(){

    Route::get('stripe', 'stripe');

    Route::post('stripe', 'stripePost')->name('stripe.post');

});



