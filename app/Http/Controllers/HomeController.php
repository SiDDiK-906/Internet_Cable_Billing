<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillPaymentMultiMonth;
use Illuminate\Contracts\Session\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Backend Dashboard
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('backend.dashboard');
    }




    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Backend Dashboard
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        return view('backend.dashboard');
    }


}
