<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    { 
        $carts = DB::table('carts')->get();

        foreach ($carts as $item) {
            
            $cartItem = Order::create([
              'username'  => Auth::user()->name,
              'name'  => $item->name,
              'description' => $item->description,
              'image' => $item->image,
              'price' => $item->price,
          ]);    
        }
        
        DB::table('carts')->delete();
        return redirect()->route('home')->with('success', 'Checkout Request Send Successfully!');
      
      }

      public function order()
      {
        $orders = Order::get();
        return view('admin.order', compact('orders'));
      }
    
}
