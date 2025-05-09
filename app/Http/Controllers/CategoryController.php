<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function create(){
        return view('admin.category.add');
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'focus_keywords' => 'array',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('category.create')
                        ->withErrors($validator)
                        ->withInput();
        }


        Category::create([
            'name'=>$request->name,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'focus_keywords' =>json_encode($request->focus_keywords),
        ]);


        return redirect()->route('category.create')->with('success','Category added successfully.');


    }


    public function list(){

        $categories = Category::all();
        return view('admin.category.list',compact('categories'));
    }



    public function edit($slug){

        $category=Category::where('slug',$slug)->firstOrFail();

        return view('admin.category.edit',compact('category'));
    }


    public function update(Request $request,$slug){

        $category=Category::where('slug',$slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'focus_keywords' => 'array',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',

        ]);

        if ($validator->fails()) {
            return redirect()->route('category.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }


        // Update the setting
        $category->update([
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'focus_keywords' => json_encode($request->focus_keywords),
        ]);

        return redirect()->route('category.list')->with('success', 'Category  updated successfully.');
    }

    public function delete($slug){
        $category=Category::where('slug',$slug)->firstOrFail();

        $category->delete();

        return redirect()->route('category.list')->with('success', 'Category deleted successfully.');
    }
}
