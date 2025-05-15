<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $beers = Product::where('category','Beer')->take(6)->get();
        $rums = Product::where('category', 'Rum')->take(6)->get();
        $vodkas = Product::where('category', 'Vodka')->take(6)->get();

        return view('frontend.home', compact('beers', 'rums', 'vodkas'));
    }



    public function beerShow(){
        $beers = Product::where('category','Beer')->paginate(10);
        return view('frontend.beer', compact('beers'));
    }

    public function rumShow(){
        $rums = Product::where('category','Rum')->paginate(10);
        return view('frontend.rum', compact('rums'));
    }

    public function vodkaShow(){
        $vodkas = Product::where('category','Vodka')->paginate(10);
        return view('frontend.vodka', compact('vodkas'));
    }

    public function cigratteShow(){
        $cigrattes = Product::where('category','Cigratte')->paginate(10);
        return view('frontend.cigratte', compact('cigrattes'));
    }

    public function snackShow(){
        $snacks = Product::where('category','Snack')->paginate(10);
        return view('frontend.snack', compact('snacks'));
    }
    public function softDrinkShow(){
        $softDrinks = Product::where('category','Soft Drink')->paginate(10);
        return view('frontend.softDrink', compact('softDrinks'));
    }




}
