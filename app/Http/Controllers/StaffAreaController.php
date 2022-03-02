<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Staff;
use App\Models\StaffArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffAreaController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }






    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Staff Area
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $staffAreas = StaffArea::all();
        return view('backend.staff-areas.index', compact('staffAreas'));
    }







    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Staff Area
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $staffs = Staff::all();
        $areas = Area::all();
        return view('backend.staff-areas.create', compact('staffs', 'areas'));
    }







    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Staff Area
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $staffArea = StaffArea::create([
            'fk_staff_id'           =>  $request->fk_staff_id,
            'fk_area_id'            =>  $request->fk_area_id,
        ]);

        Session::flash('success', 'Staff Area Added Successfully!!');
        return redirect()->route('all-staff-area');
    }








    /*
    |--------------------------------------------------------------------------
    | SHOW METHOD for
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        //
    }






    /*
    |--------------------------------------------------------------------------
    | EDIT METHOD for Edit Staff Area
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $staffs = Staff::all();
        $areas = Area::all();
        $staffArea = StaffArea::where('id',$id)->first();

        return view('backend.staff-areas.edit', compact('areas' , 'staffs', 'staffArea'));
    }







    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Staff Area
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $staffArea = StaffArea::findOrfail($id);
        $staffArea->update([
            'fk_staff_id'           =>  $request->fk_staff_id,
            'fk_area_id'            =>  $request->fk_area_id,
        ]);

        Session::flash('success', 'Staff Area Updated Successfully!!');
        return redirect()->route('all-staff-area');
    }







    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Staff Area
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $staffArea =  StaffArea::findOrfail($id);
        $staffArea->destroy($id);

        Session::flash('error', 'Staff Area Parmanently Deleted!!');
        return redirect()->route('all-staff-area');
    }

}
