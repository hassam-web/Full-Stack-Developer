<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('/posts/{post_id}',[FrontendController::class,'post_detail'])->name('post_detail');
Route::get('/categories/{cat_id}',[FrontendController::class,'category_detail'])->name('category_detail');
Route::post("/search",[FrontendController::class,'search'])->name('search');
Route::get('/register',[FrontendController::class,'register'])->name('register');
Route::post('/register',[FrontendController::class,'register_post'])->name('register_post');

Route::get('/login',[FrontendController::class,'login'])->name('login');
Route::post('login_post',[FrontendController::class,'login_post'])->name('login_post');
Route::post('logout',[FrontendController::class,'logout'])->name('logout');


// Route::get('/admin/dashboard',[AdminController::class,'index'])->name('dashboard')->middleware('auth_check');

Route::group(['prefix' => 'admin','middleware' => ['auth_check']], function() {
	Route::get('/post_like/{post}',[FrontendController::class,'post_like'])->name('post_like');
	Route::get('/post_unlike/{post}',[FrontendController::class,'post_unlike'])->name('post_unlike');
	Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
	
	/**
	 *
	 * Categories
	 *
	 */
	
	Route::get('/categories',[CategoryController::class,'index'])->name('categories');
	Route::post('/categories',[CategoryController::class,'store'])->name('categories_store');
	Route::delete('/categories/{category}',[CategoryController::class,'delete'])->name('categories_delete');
	Route::put('/categories/{category}',[CategoryController::class,'update'])->name('categories_update');

	/**
	 *
	 * Posts
	 *
	 */
	Route::get('/posts',[PostController::class,'index'])->name('posts');
	Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts_destroy');
	Route::get('/posts/create',[PostController::class,'create'])->name('post_create');
	Route::post('post/create',[PostController::class,'store'])->name('post_store');
	Route::get('/post/edit/{post}',[PostController::class,'edit'])->name('post_edit');
	Route::put('/post/edit/{post}',[PostController::class,'update'])->name('post_update');
	/**
	 *
	 * Users
	 *
	 */
	Route::get('/users',[UserController::class,'index'])->name('users');
	Route::delete('/users/{user}',[UserController::class,'destroy'])->name('user_destroy');
	Route::get('/user/create',[UserController::class,'create'])->name('user_create');
	Route::post('/user/store',[UserController::class,'store'])->name('user_store');
	Route::get('/user/edit/{user}',[UserController::class,'user_edit'])->name('user_edit');
	Route::put('/user/update/{user}',[UserController::class,'user_update'])->name('user_update');
	/**
	 *
	 * Comment
	 *
	 */
	Route::get('/comments',[CommentController::class,'index'])->name('comments');
	Route::delete('/comment/{comment}',[CommentController::class,'destroy'])->name('destroy');
	Route::post('/comment/update/status/{comment}',[CommentController::class,'comment_status'])->name('comment_status');

	Route::post('/comment/api_update_status',[CommentController::class,'api_update_status'])->name('api_update_status');
});
	Route::post('/comment/store/{post}',[CommentController::class,'store_comment'])->name('store_comment');