<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class HomeController extends Controller
{
    public function index()
    {
        $beers = Product::where('category','Beer')->where('status','active')->take(6)->get();
        $rums = Product::where('category', 'Rum')->where('status','active')->take(6)->get();
        $vodkas = Product::where('category', 'Vodka')->where('status','active')->take(6)->get();

        return view('frontend.home', compact('beers', 'rums', 'vodkas'));
    }


    public function contact(){
        return view('frontend.contact');
    }


    public function beerShow(){
        $beers = Product::where('category','Beer')->where('status','active')->paginate(10);
        return view('frontend.beer', compact('beers'));
    }

    public function rumShow(){
        $rums = Product::where('category','Rum')->where('status','active')->paginate(10);
        return view('frontend.rum', compact('rums'));
    }

    public function vodkaShow(){
        $vodkas = Product::where('category','Vodka')->where('status','active')->paginate(10);
        return view('frontend.vodka', compact('vodkas'));
    }

    public function cigratteShow(){
        $cigrattes = Product::where('category','Cigarette')->where('status','active')->paginate(10);
        return view('frontend.cigratte', compact('cigrattes'));
    }

    public function snackShow(){
        $snacks = Product::where('category','Snacks')->where('status','active')->paginate(10);
        return view('frontend.snack', compact('snacks'));
    }
    public function softDrinkShow(){
        $softDrinks = Product::where('category','SoftDrink')->where('status','active')->paginate(10);
        return view('frontend.softDrink', compact('softDrinks'));
    }




    public function productDetails($slug){
        $product = Product::where('slug', $slug)->first();
        return view('frontend.product_details', compact('product'));
    }




      public function submitForm(Request $request)
        {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
            'subject'=>'required'
        ]);

        $formData = $request->only(['name', 'email', 'message','subject']);

        Mail::to('bipintiwari118@gmail.com')->send(new ContactFormMail($formData));

        return back()->with('success', 'Thanks for contacting us! We will get back to you shortly.');
        }





}
