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
        ]);

        if ($validator->fails()) {
            return redirect()->route('category.create')
                        ->withErrors($validator)
                        ->withInput();
        }


        Category::create([
            'name'=>$request->name,
        ]);


        return redirect()->route('category.create')->with('success','Category added successfully.');


    }


    public function list(){

        $categories = Category::all();
        return view('admin.category.list',compact('categories'));
    }



    public function edit($id){

        $category=Category::findOrFail($id);

        return view('admin.category.edit',compact('category'));
    }


    public function update(Request $request,$id){

        $category=Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->route('category.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }


        // Update the setting
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category.list')->with('success', 'Category  updated successfully.');
    }

    public function delete($id){
        $category=Category::findOrFail($id);

        $category->delete();

        return redirect()->route('category.list')->with('success', 'Category deleted successfully.');
    }
}
