<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Session;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Product Category
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $productCategories = ProductCategory::all();
        return view('backend.product-categories.index', compact('productCategories'));
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Product Category
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.product-categories.create');
    }




    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Product Category
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $productCategory = ProductCategory::create([
            'category_name'       =>  $request->category_name,
        ]);

        Session::flash('success', 'Product Category Added Successfully!!');
        return redirect()->route('all-product-category');
    }




    /*
    |--------------------------------------------------------------------------
    | SHOW METHOD
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        //
    }




    /*
    |--------------------------------------------------------------------------
    | EDIT METHOD for Edit Product Category
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $productCategory = ProductCategory::findOrfail($id);
        return view('backend.product-categories.edit', compact('productCategory'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Product Category
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $productCategory = ProductCategory::findOrfail($id);


        $productCategory->update([
            'category_name'       =>  $request->category_name,
        ]);


        Session::flash('success', 'Product Category Updated Successfully!!');
        return redirect()->route('all-product-category');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Product Category
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $productCategory =  ProductCategory::findOrfail($id);
        $productCategory->destroy($id);

        Session::flash('error', 'Product Category Parmanently Deleted!!');
        return redirect()->route('all-product-category');
    }





    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Product Category
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = ProductCategory::where('status',1)->where('id',$id)->update(['status' => 0,]);
        if($deactive){
            Session::flash('info', 'Product Category Status  Deactivated!');
          return redirect(route('all-product-category'));
        }
    }




    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Product Category
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = ProductCategory::where('status',0)->where('id',$id)->update(['status' => 1,]);
        if($active){
            Session::flash('info', 'Product Category Status Actived!');
          return redirect(route('all-product-category'));
        }
     }
}
