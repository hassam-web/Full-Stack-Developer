<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\authCheck;
use App\Http\Controllers\CheckoutController;


// Add To Cart Controllers 

Route::post('addtocart', [FrontendController::class,'addtocart'])->name('addtocart');
Route::get('/shopping-cart-page', [FrontendController::class, 'shopping_cart_page'])->name('shopping-cart-page');
Route::get('/deletecartitem/{product_category_id}', [FrontendController::class, 'delete'])->name('deletecartitem');


// Home Page Controller 

Route::get('/',[FrontendController::class,'index'])->name('home');

// Catetgory Controller 

Route::get('/categories/{cat_id}',[FrontendController::class,'category_detail'])->name('category_detail');

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'
// ])->group(function () {
// });
Route::group(['middleware' => ['authCheck']], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


// Admin Controllers 

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Categories Controllers 

Route::get('/categories', [DashboardController::class, 'categories'])->name('categories');
Route::post('/categories',[DashboardController::class,'store'])->name('categories_store');
Route::get('/delete/category/{id}', [DashboardController::class, 'delete'])->name('deletecategory');
Route::put('/categories/{category}',[DashboardController::class,'update'])->name('categories_update');

// Products Controllers

Route::get('/adminproducts', [ProductController::class, 'adminproducts'])->name('adminproducts');
Route::get('/create/product', [ProductController::class, 'createproductpage'])->name('createproductpage');
Route::post('/create/product', [ProductController::class,'createproduct'])->name('createproduct');
Route::delete('/delete/product/{id}', [ProductController::class, 'delete'])->name('deleteproduct');
Route::get('product/edit/{product}',[ProductController::class,'producteditpage'])->name('producteditpage');
Route::put('/product/edit/{product}',[ProductController::class,'update'])->name('product_update');

Route::get('/user',[UserController::class,'index'])->name('user');
Route::post('checkout',[CheckoutController::class, 'checkout'])->name('check_out');
Route::get('order', [CheckoutController::class, 'order'])->name('order');
});
