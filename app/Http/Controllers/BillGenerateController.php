<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\BillGenerate;
use App\Models\Customer;
use App\Models\BillPaymentMultiMonth;
use App\Models\LineCategory;
use App\Models\PaymentOption;
use App\Models\Staff;
use App\Models\StaffArea;
use App\Models\TransactionType;
use App\Traits\FileSaver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BillGenerateController extends Controller
{
    use FileSaver;

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

        if ($request->input('area') && $request->input('year') && $request->input('month') != null) {

            $year_session = Session::put('year_session', $request->input('year'));
            $month_session = Session::put('month_session', $request->input('month'));
            $area_session = Session::put('area_session', $request->input('area'));

            $year = $request->input('year');
            $month_number = $request->input('month');
            $area_id = $request->input('area');

            $areas = Area::where('status',1)->get();



            // $BillMultiMonths = BillPaymentMultiMonth::where('fk_area_id',$request->input('area'))
            // ->where('year',$request->input('year'))
            // ->where('month', $request->input('month'))
            // ->select('id','fk_customer_id')
            // ->get();



            $customers = Customer::with('areas')
                                 ->where('fk_area_id',$request->input('area'))
                                 ->where('status',1)
                                 ->select('id','fk_area_id','customer_id','customer_name','customer_phone')
                                 ->get();

            return view('backend.bill-generate-unpaid.search',compact('areas','customers','area_id','year','month_number'));
        }
        else {
            $customers = 0;

            $areas = Area::where('status',1)->get();

            return view('backend.bill-generate-unpaid.index',compact('areas','customers'));
        }

    }




    /*
    |--------------------------------------------------------------------------
    | STORE METHOD
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        $year = Session::get('year_session');
        $month = Session::get('month_session');

        // loop for checking duplicate entry

        foreach ($request->customer_id as $key => $customer) {

            $BillPaymentMultiMonth = BillPaymentMultiMonth::where('fk_customer_id',$request->customer_id[$key])
                                        ->where('year',$year)
                                        ->where('month',$month)
                                        ->exists();

                if($BillPaymentMultiMonth){
                    $bill_exist = $request->customer_id[$key];
                    $customer_name = Customer::find($bill_exist)->customer_name;
                }
                else{
                    $getPaymentOption = PaymentOption::where('status','1')->orderBy('id','asc')->value('id');
                    $getTransitionType = TransactionType::where('status','1')->where('cost_amount',0)->value('id');

                    $customer_id = Customer::find($customer);

                    $previous_due = $customer_id->customer_due;

                    $line_id = $customer_id->fk_line_id;

                    $area_id = $customer_id->fk_area_id;

                    $due_amount = LineCategory::find($line_id)->line_amount;

                    $staff_id = Staff::where('fk_area_id',$area_id)->first()->id;

                    // updating customer due
                    $customer_id->update([
                        'customer_due' => $previous_due + $due_amount,
                    ]);

                    //line_payment_transition_method table

                    $billgenerate_id = BillGenerate::create([
                        'fk_customer_id'=> $customer,
                        'transition_id'=> 0,
                        'fk_line_transition_id'=> $getPaymentOption,
                        'fk_transition_type_id' => $getTransitionType,
                        'fk_staff_id'=> $staff_id,
                        'paid_amount'=> 0,
                        'discount'=> 0,
                        'due_amount'=> $due_amount,
                        'description'=> '',
                        'status'=> 1,
                    ]);


                    BillGenerate::find($billgenerate_id->id)->update([
                        'transition_id'=> date('ymd').$billgenerate_id->id,
                    ]);


                    //line_payment_multimonth_wise table

                    BillPaymentMultiMonth::create([
                        'fk_payment_transition_id' => $billgenerate_id->id,
                        'fk_customer_id'=> $customer,
                        'fk_area_id' => $area_id,
                        'year' => $year,
                        'month' => $month,
                        'fk_transition_type_id' => $getTransitionType,
                        'month_wise_amount' => $due_amount,
                        'month_wise_paid' => 0,
                        'discount' => 0,
                        'one_click' => 1,
                        'created_at' => date('Y-m-d h:i:s')
                    ]);


                }

        }

        return redirect()->route('all-bill-generate')->with('success','All Bill Generate Successfully');
        // if exist
        // if($bill_exist != NULL){

            //     if ($month == '01') {
            //         $month_name = 'January';
            //     }
            //     elseif($month == '02'){
            //         $month_name = 'February';
            //     }
            //     elseif($month == '03'){
            //         $month_name = 'March';
            //     }
            //     elseif($month == '04'){
            //         $month_name = 'April';
            //     }
            //     elseif($month == '05'){
            //         $month_name = 'May';
            //     }
            //     elseif($month == '06'){
            //         $month_name = 'June';
            //     }
            //     elseif($month == '07'){
            //         $month_name = 'July';
            //     }
            //     elseif($month == '08'){
            //         $month_name = 'August';
            //     }
            //     elseif($month == '09'){
            //         $month_name = 'September';
            //     }
            //     elseif($month == '10'){
            //         $month_name = 'October';
            //     }
            //     elseif($month == '11'){
            //         $month_name = 'November';
            //     }
            //     else{
            //         $month_name = 'December';
            //     }

            //     return redirect()->route('all-bill-generate')->with('error',$month_name. ', '.$year.' bill already generated for ' . $customer_name);

        // }
        // if doesn't exist
        // else{

            //     $getPaymentOption = PaymentOption::where('status','1')->orderBy('id','asc')->value('id');
            //     $getTransitionType = TransactionType::where('status','1')->where('cost_amount',0)->value('id');

            //     foreach ($request->customer_id as $index => $customer) {

            //         $customer_id = Customer::find($customer);

            //         $line_id = $customer_id->fk_line_id;

            //         $area_id = $customer_id->fk_area_id;

            //         $due_amount = LineCategory::find($line_id)->line_amount;

            //         $staff_id = Staff::where('fk_area_id',$area_id)->first()->id;


            //         //line_payment_transition_method table

            //         $billgenerate_id = BillGenerate::create([
            //             'fk_customer_id'=> $customer,
            //             'transition_id'=> 0,
            //             'fk_line_transition_id'=> $getPaymentOption,
            //             'fk_transition_type_id' => $getTransitionType,
            //             'fk_staff_id'=> $staff_id,
            //             'paid_amount'=> 0,
            //             'discount'=> 0,
            //             'due_amount'=> $due_amount,
            //             'description'=> '',
            //             'status'=> 1,
            //         ]);


            //         BillGenerate::find($billgenerate_id->id)->update([
            //             'transition_id'=> date('ymd').$billgenerate_id->id,
            //         ]);


            //         //line_payment_multimonth_wise table

            //         BillPaymentMultiMonth::create([
            //             'fk_payment_transition_id' => $billgenerate_id->id,
            //             'fk_customer_id'=> $customer,
            //             'fk_area_id' => $area_id,
            //             'year' => $year,
            //             'month' => $month,
            //             'fk_transition_type_id' => $getTransitionType,
            //             'month_wise_amount' => $due_amount,
            //             'month_wise_paid' => 0,
            //             'discount' => 0,
            //             'one_click' => 1,
            //             'created_at' => date('Y-m-d h:i:s')
            //         ]);

            //     }
            //     return redirect()->route('all-bill-generate')->with('success','All Bill Generate Successfully');
        // }
    }



    /*
    |--------------------------------------------------------------------------
    | getGenerate_ajax METHOD
    |--------------------------------------------------------------------------
    */
    public function getGenerate_ajax(Request $request)
    {
        $customer = $request->id;

        $year = Session::get('year_session');
        $month = Session::get('month_session');



        // // checking
        $BillPaymentMultiMonth = BillPaymentMultiMonth::where('fk_customer_id',$request->id)
                                ->where('year',$year)
                                ->where('month',$month)
                                ->exists();


        if($BillPaymentMultiMonth){
            // $bill_exist = $request->$customer;
            // $customer_name = Customer::find($bill_exist)->customer_name;
            $mainBtn_td =  '<option class="btn btn-sm btn-primary generate_button_class" value="{{ $customer->id }}">Generate Bill</option>';
            echo $mainBtn_td;
        }
        else{

            $getPaymentOption = PaymentOption::where('status','1')->orderBy('id','asc')->value('id');
            $getTransitionType = TransactionType::where('status','1')->where('cost_amount',0)->value('id');

            $customer_id = Customer::find($request->id);

            $line_id = $customer_id->fk_line_id;

            $area_id = $customer_id->fk_area_id;

            $due_amount = LineCategory::find($line_id)->line_amount;

            $staff_id = Staff::where('fk_area_id',$area_id)->first()->id;



            //line_payment_transition_method table

            $billgenerate_id = BillGenerate::create([
                'fk_customer_id'=> $customer,
                'transition_id'=> 0,
                'fk_line_transition_id'=> $getPaymentOption,
                'fk_transition_type_id' => $getTransitionType,
                'fk_staff_id'=> $staff_id,
                'paid_amount'=> 0,
                'discount'=> 0,
                'due_amount'=> $due_amount,
                'description'=> '',
                'status'=> 1,
            ]);


            BillGenerate::find($billgenerate_id->id)->update([
                'transition_id'=> date('ymd').$billgenerate_id->id,
            ]);


            //line_payment_multimonth_wise table

            BillPaymentMultiMonth::create([
                'fk_payment_transition_id' => $billgenerate_id->id,
                'fk_customer_id'=> $customer,
                'fk_area_id' => $area_id,
                'year' => $year,
                'month' => $month,
                'fk_transition_type_id' => $getTransitionType,
                'month_wise_amount' => $due_amount,
                'month_wise_paid' => 0,
                'discount' => 0,
                'one_click' => 1,
            ]);

            $mainBtn_td =  '<option class="btn btn-sm btn-success generate_button_class"  value="{{ $customer->id }}">Generated</option>';

            echo $mainBtn_td;

        }




    }


}
