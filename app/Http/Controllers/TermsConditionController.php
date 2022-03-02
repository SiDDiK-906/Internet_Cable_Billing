<?php

namespace App\Http\Controllers;

use App\Models\TermsCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TermsConditionController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Terms & Conditions
    |--------------------------------------------------------------------------
    */
    public function index(){
        $term = TermsCondition::first();
        return view('backend.terms-conditions.index', compact('term'));
    }






    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Terms & Conditions
    |--------------------------------------------------------------------------
    */
    public function store(Request $request){

        $term = TermsCondition::first();

        $term->update([

            'details'           => $request->details,

        ]);

        Session::flash('success', 'Successfully Terms & Conditions Updated!');
        return redirect()->back();
    }
}
