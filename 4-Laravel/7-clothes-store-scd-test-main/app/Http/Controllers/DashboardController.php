<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $category_count = Category::get()->count();
        $product_count = Product::get()->count();
        $user_count = User::get()->count();
        return view('admin.dashboard',compact('category_count','product_count','user_count'));
    }

    public function categories(Request $request)
    {
        $categories = Category::get();
        $category_row = $request->cat_id ? Category::find($request->cat_id) : null;
        return view('admin.categories.index', compact('categories','category_row'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cat_title' => 'required',
        ]);

        Category::create([
            'cat_title' => $request->cat_title
        ]);
        return back()->with('success', 'Category Insert Successfully!');
    }

    public function delete(Request $request,$id)
    {
        $category = Category::with('products')->findOrFail($id);
        $products = Category::with('products')->findOrFail($id)->products;
        $carts = Category::with('carts')->findOrFail($id)->carts;
        $category->delete();
        foreach ($products as $key => $product) {
            $product->delete();
            unlink($product->image);
        }
        foreach ($carts as $key => $cart) {
            $cart->delete();
        }
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }

    public function update(Request $request,Category $category)
    {
        $request->validate([
            'cat_title' => 'required'
        ]);

        $category->update([
            'cat_title' => $request->cat_title 
        ]);
        return back()->with('success', 'Category Updated Successfully!');
    }
}
