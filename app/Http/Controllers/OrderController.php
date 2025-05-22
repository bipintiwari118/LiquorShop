<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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


public function orderList(Request $request)
{
    // Orders that are NOT both delivered and paid

   $search = $request->input('search');

   if ($search) {
         $orders = Order::when($search, function ($query, $search) {
             $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('id', $search);
    })->latest()->paginate(10);
    }
    else{



    $orders = Order::where(function($q) {
        $q->where('delivery', '!=', 'delivered')
          ->orWhere('status', '!=', 'paid');
    })->latest()->paginate(5);


     }


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

              // ✅ Send email only if delivery is 'delivered' AND status is 'paid'
    if (strtolower($order->delivery) === 'delivered' && strtolower($order->status) === 'paid') {
        Mail::to($order->email)->send(new OrderMail($order));
    }

             return redirect()->route('order.list')->with('success', 'Order updated successfully!');

}

public function completedOrders(Request $request)
{

      $search = $request->input('search');

   if ($search) {
         $orders = Order::when($search, function ($query, $search) {
             $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('id', $search);
    })->latest()->paginate(10);
    }else{
    $orders = Order::where('delivery', 'delivered')
        ->where('status', 'paid')
        ->latest()->paginate(5);

    }

    return view('admin.order.completeOrder', compact('orders'));
}


public function orderDelete($id){
        $order = Order::findOrFail($id);
        $order->delete();

          return redirect()->route('order.list')->with('success', 'Order deleted successfully!');
}


public function orderView($id){

        $order = Order::with('orderItem')->findOrFail($id);
        return view('admin.order.view',compact('order'));

}




}
