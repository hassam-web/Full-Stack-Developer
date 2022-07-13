<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        $category_row = $request->cat_id ? Category::find($request->cat_id) : null;
        return view('admin.categories',compact('categories','category_row'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        Category::create([
            'cat_title' => $request->category_name
        ]);

        return back()->with('success', 'Category Insert Successfully!');
    }
    // public function delete(Request $request,$category)
    // {
    //     $category = Category::find($category);
    //     $category->delete();
    //     return back()->with('success', 'Category Deleted Successfully!');
    // }
    public function delete(Request $request,Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category Deleted Successfully!');
    }
    public function update(Request $request,Category $category)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        $category->update([
            'cat_title' => $request->category_name 
        ]);
        return back()->with('success', 'Category Updated Successfully!');
    }
}