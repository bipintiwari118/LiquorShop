<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
      //checkout functions

     public function create(){
         $items = \Cart::getContent();
         $total=\Cart::getTotal();

        if(empty($items)){
            return back()->with('error','Does not have any product added.');
        }

        return view('frontend.checkout',compact('items','total'));
     }

     public function store(Request $request){
        dd($request);
         $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city'=>'required',
        ]);


        // Create order
        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => \Cart::getTotal(),
        ]);

        foreach (\Cart::getContent() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        \Cart::clear();
        return redirect('/cart')->with('success', 'Order placed successfully!');
    }

}
