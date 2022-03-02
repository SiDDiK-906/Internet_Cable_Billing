<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\BillPaymentMultiMonth;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BillingStatusController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {

        if ($request->input('month') && $request->input('year') != null) {

            Session::put('recover_date',$request->input('year')."-".$request->input('month'));

            Session::put('year',$request->input('year'));

            Session::put('month',$request->input('month'));


            // only selected year month query
            $areas = Area::with('BillPaymentMultiMonthStatus','BillMultiMonth')->where('status',1)->get();

            return view('backend.billing-status.search',compact('areas'));


        }
        else {

            $carbon = Carbon::now();
            $current_year = $carbon->format('Y');
            $current_month = $carbon->format('n');

            $recover_date = Session::put('recover_date',$current_year."-".$current_month);

            // query
            $areas = Area::with('BillPaymentMultiMonthStatusCurrent','BillMultiMonthCurrent')->where('status',1)->get();


            return view('backend.billing-status.index',compact('areas'));
        }

    }




}
