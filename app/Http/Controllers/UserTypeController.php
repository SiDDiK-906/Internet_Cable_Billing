<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserTypeController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading User Type
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $userTypes = UserType::all();
        return view('backend.user-types.index', compact('userTypes'));
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create User Type
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.user-types.create');
    }




    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store User Type
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $userType = UserType::create([
            'type'            =>  $request->type,
            'type_name'       =>  $request->type_name,
        ]);

        Session::flash('success', 'User Type Added Successfully!!');
        return redirect()->route('all-user-type');
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
    | EDIT METHOD for Edit User Type
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $userType = UserType::findOrfail($id);
        return view('backend.user-types.edit', compact('userType'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update User Type
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $userType = UserType::findOrfail($id);


        $userType->update([
            'type'            =>  $request->type,
            'type_name'       =>  $request->type_name,
        ]);


        Session::flash('success', 'User Type Updated Successfully!!');
        return redirect()->route('all-user-type');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy User Type
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $userType =  UserType::findOrfail($id);
        $userType->destroy($id);

        Session::flash('error', 'User Type Parmanently Deleted!!');
        return redirect()->route('all-user-type');
    }


}
