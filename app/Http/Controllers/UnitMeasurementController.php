<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitMeasurement;
use Illuminate\Support\Facades\Session;

class UnitMeasurementController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Unit Measurement
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $unitMeasurements = UnitMeasurement::all();
        return view('backend.unit-measurements.index', compact('unitMeasurements'));
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Unit Measurement
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.unit-measurements.create');
    }




    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Unit Measurement
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $unitMeasurement = UnitMeasurement::create([

            'uom_name'       =>  $request->uom_name,


        ]);

        Session::flash('success', 'Unit Measurement Added Successfully!!');
        return redirect()->route('all-unit-measurement');
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
    | EDIT METHOD for Edit Unit Measurement
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $unitMeasurement = UnitMeasurement::findOrfail($id);
        return view('backend.unit-measurements.edit', compact('unitMeasurement'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Unit Measurement
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $unitMeasurement = UnitMeasurement::findOrfail($id);


        $unitMeasurement->update([

            'uom_name'       =>  $request->uom_name,
        ]);


        Session::flash('success', 'Unit Measurement Updated Successfully!!');
        return redirect()->route('all-unit-measurement');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy UnitMeasurement
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $unitMeasurement =  UnitMeasurement::findOrfail($id);
        $unitMeasurement->destroy($id);

        Session::flash('error', 'Unit Measurement Parmanently Deleted!!');
        return redirect()->route('all-unit-measurement');
    }





    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Unit Measurement
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = UnitMeasurement::where('status',1)->where('id',$id)->update(['status' => 0,]);
        if($deactive){
            Session::flash('info', 'Unit Measurement Status  Deactivated!');
          return redirect(route('all-unit-measurement'));
        }
    }




    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Unit Measurement
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = UnitMeasurement::where('status',0)->where('id',$id)->update(['status' => 1,]);
        if($active){
            Session::flash('info', 'Unit Measurement Status Actived!');
          return redirect(route('all-unit-measurement'));
        }
     }
}
