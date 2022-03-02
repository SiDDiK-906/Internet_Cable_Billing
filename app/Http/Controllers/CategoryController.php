<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\FileSaver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    use FileSaver;

    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Category
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Reading Category
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.categories.create');
    }



    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Reading Category
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        Category::create([
            'category_name'     => $request->category_name,
            'company_name'              =>  $request->company_name,
            'category_type'             =>  $request->category_type,
            'category_status'          =>  $request->category_status,
            'created_by'          =>  Auth()->id(),
        ]);

        Session::flash('success', 'Category Added Successfully!!');
        return redirect()->route('all-category');
    }



    /*
    |--------------------------------------------------------------------------
    | SHOW METHOD for Reading Category
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        //
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT METHOD for Reading Category
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $category = Category::findOrfail($id);
        return view('backend.categories.edit', compact('category'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Reading Category
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        // return $request;
        // die();

        $category = Category::findOrfail($id);

        $category->update([
            'category_name'        =>  $request->category_name,
            'company_name'         =>  $request->company_name,
            'category_type'        =>  $request->category_type ,
            'category_status'      =>  $request->category_status,
        ]);

        Session::flash('success', 'Category Updated Successfully!!');
        return redirect()->route('all-category');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Reading Category
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $category =  Category::findOrfail($id);

        $category->destroy($id);

        Session::flash('error', 'Category Parmanently Deleted!!');
        return redirect()->route('all-category');
    }



    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Reading Category
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = Category::where('category_status',1)->where('id',$id)->update(['category_status' => 0,]);
        if($deactive){
            Session::flash('info', 'Category Status Deactivated!');
          return redirect(route('all-category'));
        }
    }



    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Reading Category
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = Category::where('category_status',0)->where('id',$id)->update(['category_status' => 1,]);
        if($active){
            Session::flash('info', 'Category Status Actived!');
          return redirect(route('all-category'));
        }
     }
}
