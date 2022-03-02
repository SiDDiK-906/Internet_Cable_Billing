<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Address
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $addresses = Address::all();
        return view('backend.addresses.index', compact('addresses'));
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Address
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.addresses.create');
    }




    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Address
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $address = Address::create([
            'address'          =>  $request->address,
            'country_name'     =>  $request->country_name,
            'city_name'        =>  $request->city_name,
            'zip_code'         =>  $request->zip_code,
            'division'         =>  $request->division,
        ]);

        Session::flash('success', 'Address Added Successfully!!');
        return redirect()->route('all-address');
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
    | EDIT METHOD for Edit Address
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $address = Address::findOrfail($id);
        return view('backend.addresses.edit', compact('address'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Address
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $address = Address::findOrfail($id);


        $address->update([
            'address'          =>  $request->address,
            'country_name'     =>  $request->country_name,
            'city_name'        =>  $request->city_name,
            'zip_code'         =>  $request->zip_code,
            'division'         =>  $request->division,
        ]);


        Session::flash('success', 'Address Updated Successfully!!');
        return redirect()->route('all-address');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Address
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $address =  Address::findOrfail($id);
        $address->destroy($id);

        Session::flash('error', 'Address Parmanently Deleted!!');
        return redirect()->route('all-address');
    }


}
