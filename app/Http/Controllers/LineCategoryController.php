<?php

namespace App\Http\Controllers;

use App\Models\LineCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LineCategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }




    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Line Category
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $lineCategories = LineCategory::all();
        return view('backend.line-categories.index', compact('lineCategories'));
    }






    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Line Category
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.line-categories.create');
    }






    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Line Category
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $lineCategory = LineCategory::create([
            'line_name'     =>  $request->line_name,
            'line_amount'  =>  $request->line_amount,
        ]);

        Session::flash('success', 'Line Category Added Successfully!!');
        return redirect()->route('all-line-category');
    }






    /*
    |--------------------------------------------------------------------------
    | SHOW METHOD for Line Category
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        //
    }






    /*
    |--------------------------------------------------------------------------
    | EDIT METHOD for Edit Line Category
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $lineCategory = LineCategory::findOrfail($id);
        return view('backend.line-categories.edit', compact('lineCategory'));
    }






    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Line Category
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $lineCategory = LineCategory::findOrfail($id);
        $lineCategory->update([
            'line_name'     =>  $request->line_name,
            'line_amount'  =>  $request->line_amount,
        ]);


        Session::flash('success', 'Line Category Updated Successfully!!');
        return redirect()->route('all-line-category');
    }






    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Line Category
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $area = LineCategory::findOrfail($id);
        $area->destroy($id);

        Session::flash('error', 'Line Category Parmanently Deleted!!');
        return redirect()->route('all-line-category');
    }






    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Line Category
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = LineCategory::where('line_status',1)->where('id',$id)->update(['line_status' => 0,]);
        if($deactive){
            Session::flash('info', 'Line Category Status  Deactivated!');
          return redirect(route('all-line-category'));
        }
    }






    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Line Category
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = LineCategory::where('line_status',0)->where('id',$id)->update(['line_status' => 1,]);
        if($active){
            Session::flash('info', 'Line Category Status Actived!');
          return redirect(route('all-line-category'));
        }
     }
}
