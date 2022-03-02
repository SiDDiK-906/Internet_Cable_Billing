<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductBrandController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Product Brand
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $productBrands = ProductBrand::all();
        return view('backend.product-brands.index', compact('productBrands'));
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Product Brand
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.product-brands.create');
    }




    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store ProductBrand
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $productBrand = ProductBrand::create([

            'brand_name'       =>  $request->brand_name,


        ]);

        Session::flash('success', 'Product Brand Added Successfully!!');
        return redirect()->route('all-product-brand');
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
    | EDIT METHOD for Edit Product Brand
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $productBrand = ProductBrand::findOrfail($id);
        return view('backend.product-brands.edit', compact('productBrand'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Product Brand
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $productBrand = ProductBrand::findOrfail($id);


        $productBrand->update([
            'brand_name'       =>  $request->brand_name,

        ]);


        Session::flash('success', 'Product Brand Updated Successfully!!');
        return redirect()->route('all-product-brand');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Product Brand
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $productBrand =  ProductBrand::findOrfail($id);
        $productBrand->destroy($id);

        Session::flash('error', 'Product Brand Parmanently Deleted!!');
        return redirect()->route('all-product-brand');
    }





    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive ProductBrand
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = ProductBrand::where('status',1)->where('id',$id)->update(['status' => 0,]);
        if($deactive){
            Session::flash('info', 'Product Brand Status  Deactivated!');
          return redirect(route('all-product-brand'));
        }
    }




    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Product Brand
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = ProductBrand::where('status',0)->where('id',$id)->update(['status' => 1,]);
        if($active){
            Session::flash('info', 'Product Brand Status Actived!');
          return redirect(route('all-product-brand'));
        }
     }
}
