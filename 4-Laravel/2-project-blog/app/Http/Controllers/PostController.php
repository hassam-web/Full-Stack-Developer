<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('admin.posts.index',compact('posts'));
    }
    public function destroy(Request $request,Post $post)
    {
        unlink($post->post_image); //it will delete the image from url
        $post->delete();
        return back()->with(['success' => 'post is deleted successfully!']);
    }
    public function create()
    {
        return view('admin.posts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'post_title' => 'required',
            'post_category_id' => 'required',
            'post_author' => 'required',
            'post_date' => 'required',
            'post_status' => 'required',
            'post_content' => 'required',
            // 'post_image' => 'required|image',
        ]);

        $imageName = null;

        if ($request->post_image) {
            $imageName = "post_images/" .time().'.'.$request->post_image->extension();  
            $request->post_image->move(public_path('post_images'), $imageName);
        }

        $post = Post::create([
            'post_title' => $request->post_title,
            'post_category_id' => $request->post_category_id,
            'slug' => Str::slug($request->post_title),
            'post_author' => $request->post_author,
            'post_date' => $request->post_date,
            'post_status' => $request->post_status,
            'post_tags' => $request->post_tags,
            'post_content' => $request->post_content,
            'post_image' =>  $imageName,
        ]);

        /*$post = new Post();
        $post->post_title = $request->post_title;
        $post->post_category_id = $request->post_category_id;
        $post->slug = Str::slug($request->post_title);
        $post->post_author = $request->post_author;
        $post->post_date = $request->post_date;
        $post->post_status = $request->post_status;
        $post->post_content = $request->post_content;
        $post->post_image = "/post_images/" . $imageName;
        $post->save();*/

        return redirect()->route('posts')->with(['success' => 'Post Created Succesfully']);
    }

    // public function edit(Request $request,$post_id)
    public function edit(Request $request,Post $post)
    {
        return view('admin.posts.edit',compact('post'));
    }

    public function update(Request $request,Post $post)
    {
        $request->validate([
            'post_title' => 'required',
            'post_category_id' => 'required',
            'post_author' => 'required',
            'post_date' => 'required',
            'post_status' => 'required',
            'post_content' => 'required',
            // 'post_image' => 'required|image',
        ]);

        $imageUrl = $post->post_image;

        if($request->post_image){
            unlink($post->post_image);
            $imageName = time().'.'.$request->post_image->extension();  
            $request->post_image->move(public_path('post_images'), $imageName);

            $imageUrl = "post_images/" . $imageName;
        }

        $post->update([
            'post_title' => $request->post_title,
            'post_category_id' => $request->post_category_id,
            'slug' => Str::slug($request->post_title),
            'post_author' => $request->post_author,
            'post_date' => $request->post_date,
            'post_status' => $request->post_status,
            'post_tags' => $request->post_tags,
            'post_content' => $request->post_content,
            'post_image' => $imageUrl,
        ]);

        return back()->with(['success' => 'Post Updated Succesfully']);
    }
}