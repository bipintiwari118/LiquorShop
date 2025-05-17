<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CartController extends Controller
{


    public function index(){
        $total=\Cart::getTotal();
        $items = \Cart::getContent();

         if(empty($items)){
            return route('cart')->with('error','Does not have any product added.');
        }

            return view('frontend.cart',compact('items','total'));
    }

    public function addCart($id){
        $product = Product::findOrFail($id);

       \Cart::add(array(
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(
                'image'=>$product->featured_image,
                'volume'=>$product->volume,
            ),
            'associatedModel' => $product


        ));

        return redirect()->route('cart')->with('success','Product Added successfully.');



    }



public function updateAjax(Request $request, $id)
{
    $item = \Cart::get($id);
    $quantity = $item->quantity;

    if ($request->action === 'increase' && $quantity < 50) {
        $quantity++;
    } elseif ($request->action === 'decrease' && $quantity > 1) {
        $quantity--;
    }

    \Cart::update($id, [
       'quantity' => [
            'relative' => false,
            'value' => $quantity
        ]
    ]);

      $total = \Cart::getTotal();
    return response()->json([
        'quantity' => $quantity,
        'subtotal' => $quantity * $item->price,
         'total' => number_format($total, 2)
    ]);
    }



    public function cartRemove($id){
        \Cart::remove($id);

         return back()->with('success','Product has been remove successfully');
    }


    public function cartClear(){

        \Cart::clear();

         return back()->with('success','Cart has been  successfully Clear.');
    }




   
}
