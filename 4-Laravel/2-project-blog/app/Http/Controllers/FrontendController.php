<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->get();
        // $posts = \App\Models\Post::get();
        return view('home')->with([
            'posts'=>$posts
        ]);
    }

    public function post_detail(Request $request,$post_id)
    {
        $post_row = Post::with('category','comments','comments.post','comments.user')->findOrFail($post_id);
        return view('post_detail',compact('post_row'));
    }
    public function category_detail(Request $request,$cat_id)
    {
        $posts = Category::with('posts')->findOrFail($cat_id)->posts;
        
        return view('category_detail',compact('posts'));
    }
    public function search(Request $request)
    {
        // dd($request->all());
        $query = "%$request->query_custom%";
        // dd($query);
        $posts = Post::with('category')->where('post_title','LIKE',$query)->get();

        return view('search',compact('posts'));
        // return view('search')->with('posts' => $posts);
    }
    public function register(Request $request)
    {
        return view('register');
    }
    public function register_post(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "username" => 'required',
            "user_firstname" => 'required',
            "user_lastname" => 'required',
            "email" => 'required|email|unique:users',
            // "user_image" => "required|image",
            "password" => "required|confirmed|min:6",
        ]);

        $imageName = '';
        if ($request->user_image) {
            $imageName = time().'.'.$request->user_image->extension();  
            $request->user_image->move(public_path('user_izmages'), $imageName);
        }


        User::create([
            "username" => $request->username,
            "user_firstname" => $request->user_firstname,
            "user_lastname" => $request->user_lastname,
            "email" => $request->email,
            "user_role" => "Admin",
            "user_image" => "user_images/" . $imageName,
            "password" => Hash::make($request->password),
        ]);

        return redirect()->back()->with(['success'=>'User Registered Successfully']);
    }

    public function login(Request $request)
    {
        return view('login');
    }
    public function login_post(Request $request)
    {
        $request->validate([
            "email" => 'required|email',
            "password" => "required",
        ]);

        $credentials = $request->only('email','password');
        $login = Auth::attempt($credentials); 

        if($login){
            return redirect()->route('home');
        }else{
            return redirect()->back()->with(['error' => 'credentails not match!']);
        }
        // dd($request->all());
    }
    public function logout()
    {
        Auth::logout();
        return back();
    }
}