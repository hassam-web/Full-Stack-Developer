<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\api\v1\DashboardController;
use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\PostController;
use App\Http\Controllers\api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login',[UserController::class,'login'])->name('frontend_login');

Route::middleware('auth:api')->group( function () { 
    Route::resource('users', UserController::class)->except([
        'create', 'edit',
    ]);
    Route::resource('categories', CategoryController::class)->except([
        'create', 'edit',
    ]);
    Route::resource('posts', PostController::class)->except([
        'create', 'edit',
    ]);
    Route::get('/comments/{post_id}',[CommentController::class,'index'])->name('comments');
    Route::post('/comments',[CommentController::class,'store'])->name('store.comment');

    Route::get('/comments/approve/{comment_id}',[CommentController::class,'comment_approve'])->name('comment_approve');
    Route::get('/comments/unapprove/{comment_id}',[CommentController::class,'comment_unapprove'])->name('comment_unapprove');


    Route::get('/count',[DashboardController::class,'index'])->name('dashboard');
});