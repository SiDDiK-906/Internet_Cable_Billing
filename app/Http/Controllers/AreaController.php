<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AreaController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Area
    |--------------------------------------------------------------------------
    */
    public function index()
    {

        $areas = Area::all();

        return view('backend.areas.index', compact('areas'));
    }





    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Area
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.areas.create');
    }

    // store
    public function store(Request $request)
    {
        $area = Area::create([
            'area_name'  =>  $request->area_name,
            'status'=> 1,
        ]);

        Session::flash('success', 'Area Added Successfully!!');
        return redirect()->route('all-area');
    }





    /*
    |--------------------------------------------------------------------------
    | SHOW METHOD for Area
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        //
    }

    // edit
    public function edit($id)
    {
        $area = Area::findOrfail($id);
        return view('backend.areas.edit', compact('area'));
    }

    // update
    public function update(Request $request, $id)
    {
        $area = Area::findOrfail($id);


        $area->update([
            'area_name' =>  $request->area_name,
        ]);


        Session::flash('success', 'Area Updated Successfully!!');
        return redirect()->route('all-area');
    }

    // destroy
    public function destroy($id)
    {
        $area =  Area::findOrfail($id);
        $area->destroy($id);

        Session::flash('error', 'Area Parmanently Deleted!!');
        return redirect()->route('all-area');
    }





    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Area
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = Area::where('status',1)->where('id',$id)->update(['status' => 0,]);
        if($deactive){
            Session::flash('info', 'Area Status  Deactivated!');
          return redirect(route('all-area'));
        }
    }





    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Area
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = Area::where('status',0)->where('id',$id)->update(['status' => 1,]);
        if($active){
            Session::flash('info', 'Area Status Actived!');
          return redirect(route('all-area'));
        }
     }
}
