<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $product = Product::get();
        $total = DB::table('carts')->sum('price');
        return view('home', compact('product', 'total'));
    }

    public function category_detail(Request $request,$cat_id)
    {
        $products = Category::with('products')->findOrFail($cat_id)->products;
        $total = DB::table('carts')->sum('price');
        return view('category_detail',compact('products', 'total'));
    }

    public function addtocart(Request $request)
    {
        if(Auth::id())
        {
          $user = auth()->user();  
          
          $cart = Cart::create([
          'product_category_id' => $request->product_category_id,
          'name' => $request->name,
          'price' => $request->price,
          'description' => $request->description,
          'image' => $request->image,
      ]);
      return redirect()->back()->with('success', 'Product Added to Cart!');
     }
     else
     {
        return redirect('login');
     }
   }

    public function shopping_cart_page()
    {
        $carts = Cart::get();
        $total = DB::table('carts')->sum('price');
        return view('shopping-cart', compact('carts', 'total'));
    }

    public function delete($product_category_id)
    {
        $cart_item_delete = Cart::find($product_category_id);
        $cart_item_delete->delete();
        return redirect()->back()->with('success', 'Cart item Deleted Successfully');
    }
  }
