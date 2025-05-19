<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
      //checkout functions



     public function create(){

         $items = \Cart::getContent();

        if ($items->isEmpty()) {
        return back()->with('error', 'Does not have any product added.');
            }


         $total=\Cart::getTotal();



        return view('frontend.checkout',compact('items','total'));
     }


      public function createQr(Request $request){

         $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

         $total=\Cart::getTotal();
         $name=$request->name;
         $email=$request->email;
         $phone=$request->phone;
         $address=$request->address;



        return view('frontend.checkoutQr',compact('total','name','email','phone','address'));
     }

     public function store(Request $request){


         $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
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

        return redirect()->route('cart')->with('success', 'Order placed successfully!');
    }





    //for backend


public function orderList()
{
    // Orders that are NOT both delivered and paid
    $orders = Order::where(function($q) {
        $q->where('delivery', '!=', 'delivered')
          ->orWhere('status', '!=', 'paid');
    })->paginate(5);


    return view('admin.order.list', compact('orders'));
}


public function orderEdit($id){
    $order=Order::findOrFail($id);

    return view('admin.order.edit',compact('order'));
}


public function orderUpdate(Request $request,$id){

      $order = Order::findOrFail($id);

       $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'delivery' => 'required',
            'status' => 'required',
            'total'=>'required',
        ]);



            $order->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'total' => $request->total,
                'delivery'=>$request->delivery,
                'status'=>$request->status,

            ]);

             return redirect()->route('order.list')->with('success', 'Order updated successfully!');

}

public function completedOrders()
{
    $orders = Order::where('delivery', 'delivered')
        ->where('status', 'paid')
        ->paginate(5);

    return view('admin.order.completeOrder', compact('orders'));
}


}
