<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{

    public function create(){
        $categories = Category::all();
        return view('admin.product.add', compact('categories'));

    }


    public function storeProduct(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category' => 'required',
            'volume' => 'required',
            'alcohol' => 'required',
            'brand' => 'nullable',
            'status' => 'required|in:active,block',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'focus_keywords' => 'array',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $featuredImage = $request->file('featured_image');
        $featuredImageName = time().'.'.$featuredImage->extension();
        $featuredImage->move(public_path('Product/images/featured_image/'),$featuredImageName);
        $featuredImagePath = 'Product/images/featured_image/' . $featuredImageName;

        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'volume' => $request->volume,
            'brand' => $request->brand,
            'alcohol' => $request->alcohol,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'focus_keywords' => $request->focus_keywords ? json_encode($request->focus_keywords) : null,
            'featured_image' => $featuredImagePath,
        ]);

        return redirect()->route('product.create')->with('success', 'Product created successfully.');

    }


    public function list(){
        $products = Product::where('status', 'active')->paginate(1);
        return view('admin.product.list', compact('products'));
    }


    public function delete($slug){
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }


    public function edit($slug){
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $categories = Category::all();
            return view('admin.product.edit', compact('product', 'categories'));
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }

    public function update(Request $request, $slug){
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'category' => 'required',
                'volume' => 'required',
                'alcohol' => 'required',
                'brand' => 'nullable',
                'status' => 'required|in:active,block',
                'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'focus_keywords' => 'array',
                'meta_title' => 'nullable|string',
                'meta_description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('featured_image')) {
                $featuredImage = $request->file('featured_image');
                $featuredImageName = time().'.'.$featuredImage->extension();
                $featuredImage->move(public_path('Product/images/featured_image/'),$featuredImageName);
                $featuredImagePath = 'Product/images/featured_image/' . $featuredImageName;
            } else {
                $featuredImagePath = $product->featured_image;
            }

            $product->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'category' => $request->category,
                'volume' => $request->volume,
                'brand' => $request->brand,
                'alcohol' => $request->alcohol,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'focus_keywords' => $request->focus_keywords ? json_encode($request->focus_keywords) : null,
                'status' => $request->status,
                'featured_image' => $featuredImagePath,
            ]);

            return redirect()->route('product.list')->with('success', 'Product updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }


}
