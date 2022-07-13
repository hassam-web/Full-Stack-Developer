<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function index(Request $request)
   {
       // $post_count = count(Post::get()->toArray());
       $post_count = Post::get()->count();
       $comment_count = Comment::get()->count();
       $user_count = User::get()->count();
       $category_count = Category::get()->count();
       return view('admin.dashboard',compact('post_count','comment_count','user_count','category_count'));
   }
}