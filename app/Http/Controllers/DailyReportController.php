<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Staff;
use App\Models\StaffArea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DailyReportController extends Controller
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
        if ($request->input('year') && $request->input('month') && $request->input('day') != null) {

            $recover_date = Session::put('report_date',$request->input('year')."-".$request->input('month')."-".$request->input('day'));

            $year_session = Session::put('year_session',$request->input('year'));
            $month_session = Session::put('month_session',$request->input('month'));
            $day_session = Session::put('day_session',$request->input('day'));

            // $areas = Area::with(['StaffArea' => function($q){

                //     $q->with(['Staff2' => function($q){

                //         $q->where('staff_status',1);

                //     }]);

            // }])->get();
            // $areas = Area::where('status',1)->select('id', 'area_name')->paginate(10);


            $staffs = Staff::with(['BillGenerate' => function($q){

                $q->where('payment_date', Session::get('report_date'))->where('paid_amount','!=',0);

            }])->where('staff_status',1)
               ->get();

            //    return $staffs;
            //    die();

               return view('backend.daily-report.search',compact('staffs'));

        }
        else {
            $carbon = Carbon::now();
            $current_year = $carbon->format('Y');
            $current_month = $carbon->format('m');
            $current_day = $carbon->format('d');

            $recover_date = Session::put('report_date',$current_year."-".$current_month."-".$current_day);

            $staffs = Staff::with(['BillGenerate' => function($q){

                $q->where('payment_date', Session::get('report_date'))->where('paid_amount','!=',0);

            }])->where('staff_status',1)
               ->get();

                // $staffs = 0;
            return view('backend.daily-report.index',compact('staffs'));
        }

    }



}
