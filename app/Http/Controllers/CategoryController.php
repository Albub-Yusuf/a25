<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){

        $data['categories'] = Category::orderBy('id','DESC')->get();
        $data['serial'] = 1;
        return view('category.index',$data);
     }
 
     public function create(){
         return view('category.create');
     }
 
     public function store(Request $request){
         $request->validate([
             'category' => 'required'
         ]);
 
       Category::create(['category'=>$request->category, 'created_by'=>Auth::user()->id]);
 
        return back()->with('message','Category has been added!');
         
 
     }
 
     public function edit(Category $category){
         
         $categoryDetails = Category::where('id',$category->id)->first();
         return view('category.edit',['categoryDetails'=>$categoryDetails]);
     }
 
     public function update(Category $category,Request $request){
 
         $request->validate([
             'category'=>'required'
         ]);
 
         Category::where('id',$category->id)->update(['category'=>$request->category]);
         return redirect()->route('category.index')->with('message','Category updated successfully!');
     }
 
     public function destroy(Category $category){
         Category::where('id',$category->id)->delete();
         return  back()->with('message','Category has been deleted!');
     }
}
