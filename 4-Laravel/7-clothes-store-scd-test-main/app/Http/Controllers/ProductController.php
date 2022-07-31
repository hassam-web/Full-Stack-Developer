<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function adminproducts()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    public function createproductpage()
    {
        return view('admin.product.create');
    }

    public function createproduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image',
        ]);

        $imageName = null;

        if ($request->image) {
            $imageName = "images/" .time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        }

        $post = Product::create([
            'name' => $request->name,
            'product_category_id' => $request->product_category_id,
            'description' => $request->description,
            'price' => $request->price,
            'image' =>  $imageName,
        ]);

        return redirect()->route('adminproducts')->with(['success' => 'Product Created Succesfully']);
    }

    public function delete (Request $request,$id)
    {
        $product = Product::findOrFail($id);
        // $carts = Product::with('carts')->findOrFail($id)->carts;
        $cart = Cart::findOrFail($product->id);
        // dd($carts);
        $product->delete();
        $cart->delete();
        unlink($product->image);
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }

    public function producteditpage(Request $request, Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request,Product $product)
    {
        $request->validate([
            'product_category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $imageUrl = $product->image;

        if($request->image){
            unlink($product->image);
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);

            $imageUrl = "images/" . $imageName;
        }

        $product->update([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageUrl,
        ]);

        return redirect()->route('adminproducts')->with(['success' => 'Product Updated Succesfully']);
    }
}
