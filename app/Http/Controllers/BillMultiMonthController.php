<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\BillGenerate;
use App\Models\Customer;
use App\Models\BillPaymentMultiMonth;
use App\Models\PaymentOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\LineCategory;
use App\Models\PaymentDue;
use App\Models\Staff;
use App\Models\StaffArea;
use App\Models\TransactionType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillMultiMonthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {

        if ($request->input('area') && $request->input('month') && $request->input('year') && $request->input('condition') && $request->input('sms_message') != null) {

            $year = $request->input('year');
                $year_session = Session::put('year_session',$request->input('year'));

            $month = $request->input('month');
                $month_session = Session::put('month_session',$request->input('month'));

            $area = $request->input('area');
                $area_session = Session::put('area_session',$request->input('area'));

            $condition = $request->input('condition');
                $condition_session = Session::put('condition_session',$request->input('condition'));

            $sms_message = $request->input('sms_message');

            $areas = Area::where('status',1)->get();


            // checking for condition
            if ($request->input('condition') == 'paid') {
                $bills_multi_month = BillPaymentMultiMonth::where('month_wise_paid', '!=' , 0)
                ->where('year',$year)
                ->where('month',$month)
                ->where('fk_area_id',$area)
                ->get();
            }
            elseif ($request->input('condition') == 'unpaid') {
                $bills_multi_month = BillPaymentMultiMonth::where('month_wise_paid', 0)
                ->where('year',$year)
                ->where('month',$month)
                ->where('fk_area_id',$area)
                ->get();
            }
            else{
                $bills_multi_month = BillPaymentMultiMonth::where('year',$year)
                ->where('month',$month)
                ->where('fk_area_id',$area)
                ->get();
            }


            return view('backend.bill-month-wise-transition.search',compact('areas','bills_multi_month'));
        }
        else {

            $areas = Area::where('status',1)->get();

            $bills_multi_month = 0;

            return view('backend.bill-month-wise-transition.index',compact('areas','bills_multi_month'));
        }

    }



    /*
    |--------------------------------------------------------------------------
    | VIEW VOCHER METHOD
    |--------------------------------------------------------------------------
    */
    public function view_bill(Request $request)
    {

        if ($request->input('area') && $request->input('month') && $request->input('customer_id') && $request->input('year') && $request->input('condition') != null) {

            $year = $request->input('year');
            $month = $request->input('month');
            $area = $request->input('area');
            $condition = $request->input('condition');
            $customer_id = $request->input('customer_id');
            $condition_session = Session::put('condition_session',$request->input('condition'));
            $sms_message = $request->input('sms_message');

            $areas = Area::where('status',1)->get();


            // checking for condition
            if ($request->input('condition') == 'paid') {
                $bills_multi_month = BillPaymentMultiMonth::where('fk_customer_id',$customer_id)
                ->where('month_wise_paid', '!=' , 0)
                // ->where('year',$year)
                // ->where('month',$month)
                ->where('fk_area_id',$area)
                ->get();
            }
            elseif ($request->input('condition') == 'unpaid') {
                $bills_multi_month = BillPaymentMultiMonth::where('fk_customer_id',$customer_id)
                ->where('month_wise_paid', 0)
                // ->where('year',$year)
                // ->where('month',$month)
                ->where('fk_area_id',$area)
                ->get();
            }
            else{
                $bills_multi_month = BillPaymentMultiMonth::where('fk_customer_id',$customer_id)
                // ->where('year',$year)
                // ->where('month',$month)
                ->where('fk_area_id',$area)
                ->get();
            }

            // return $bills_multi_month;
            // die();

            return view('backend.bill-month-wise-transition.voucher',compact('areas','bills_multi_month'));
        }
        else {

                $carbon = Carbon::now();
                $current_year = $carbon->format('Y');
                $current_month = $carbon->format('n');
                $customer_id = 245;

            if (Auth()->user()->type == 0) {

                $area = 16;

                $areas = Area::where('status',1)->get();

            } else {

                $staff_id = Auth()->user()->fk_staff_id;

                $area = Staff::find($staff_id)->fk_area_id;

                $areas = Area::find($area);

            }

            $bills_multi_month = BillPaymentMultiMonth::where('fk_customer_id',$customer_id)
            // ->
            // ->where('month',$current_month)
            ->where('fk_area_id',$area)
            ->get();

            return view('backend.bill-month-wise-transition.voucher',compact('areas','bills_multi_month'));
        }

    }





    /*
    |--------------------------------------------------------------------------
    | getID_ajax METHOD Paid btn
    |--------------------------------------------------------------------------
    */
    public function getID_ajax(Request $request)
    {
        $id = $request->id;

        $bill_multi_month = BillPaymentMultiMonth::find($id);


        $customer_id = Customer::find($bill_multi_month->fk_customer_id);

        $previous_due = $customer_id->customer_due;

        $line_id = $customer_id->fk_line_id;

        $due_amount = LineCategory::find($line_id)->line_amount;

        // updating customer due
        $customer_id->update([
            'customer_due' => $previous_due - $due_amount,
        ]);

        // line_payment_transition_method table
        BillGenerate::find($bill_multi_month->fk_payment_transition_id)->update([
            'payment_date'=> date('Y-m-d'),
            'paid_amount'=> $bill_multi_month->month_wise_amount,
            'due_amount'=> 0,
            'status'=> 0,
        ]);


        // line_payment_multimonth_wise table
        $bill_multi_month->update([
            'month_wise_paid' => $bill_multi_month->month_wise_amount,
            'one_click' => 0,
            'receive_date' => date('Y-n'),
        ]);


        $mainBtn_td =  '<option class="btn btn-sm btn-info paid_btn"  value="{{ $bill_multi_month->id }}">Paid</option>';

        echo $mainBtn_td;
        // return response([
        //     'mainBtn_td' => $mainBtn_td,
        // ]);
    }




    /*
    |--------------------------------------------------------------------------
    | getID_ajax METHOD
    |--------------------------------------------------------------------------
    */
    public function getPaidID_ajax(Request $request)
    {
        $id = $request->id;

        $bill_multi_month = BillPaymentMultiMonth::find($id);

        $customer_id = Customer::find($bill_multi_month->fk_customer_id);

        $previous_due = $customer_id->customer_due;

        $line_id = $customer_id->fk_line_id;

        $due_amount = LineCategory::find($line_id)->line_amount;

        // updating customer due
        $customer_id->update([
            'customer_due' => $previous_due + $due_amount,
        ]);


        // line_payment_transition_method table
        BillGenerate::find($bill_multi_month->fk_payment_transition_id)->update([
            'payment_date'=> NULL,
            'paid_amount'=> 0,
            'due_amount'=> $bill_multi_month->month_wise_amount,
            'status'=> 1,
        ]);


        // line_payment_multimonth_wise table
        $bill_multi_month->update([
            'month_wise_paid' => 0,
            'one_click' => 1,
            'receive_date' => NULL,
        ]);


        $mainBtn_td =  '<option class="btn btn-sm btn-danger unpaid_btn"  value="{{ $bill_multi_month->id }}">Unpaid</option>';

        echo $mainBtn_td;
        // return response([
        //     'mainBtn_td' => $mainBtn_td,
        // ]);
    }


    /*
    |--------------------------------------------------------------------------
    | MULTIPLE BILL UPDATE METHOD
    |--------------------------------------------------------------------------
    */
    public function multiple_bill_update(Request $request)
    {


        foreach ($request->bill_multi_month_id as $index => $bill_multi_month_id) {

            $bill_multi_month = BillPaymentMultiMonth::find($bill_multi_month_id);

            // line_payment_transition_method table
            BillGenerate::find($bill_multi_month->fk_payment_transition_id)->update([
                'payment_date'=> date('Y-m-d'),
                'paid_amount'=> $bill_multi_month->month_wise_amount,
                'due_amount'=> 0,
                'status'=> 0,
            ]);


            // line_payment_multimonth_wise table
            $bill_multi_month->update([
                'month_wise_paid' => $bill_multi_month->month_wise_amount,
                'one_click' => 0,
                'receive_date' => date('Y-n'),
            ]);

        }

        return back()->with('success','All Bill Paid Successfully');

    }






    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD
    |--------------------------------------------------------------------------
    */
    public function create()
    {

        $areas = Area::where('status',1)->get();

        $transition_types = TransactionType::get();

        return view('backend.bill-month-wise-transition.create',compact('areas','transition_types'));

    }








    /*
    |--------------------------------------------------------------------------
    | getName_ajax METHOD
    |--------------------------------------------------------------------------
    */
    public function getName_ajax(Request $request)
    {

        $customer_name = "<option value=''>Select a Customer</option>";

        foreach (Customer::where('fk_area_id',$request->area_id)->get(['id','customer_name','customer_phone']) as $customer_data) {
            $customer_name .= "<option value='$customer_data->id'> $customer_data->customer_name</option>";
        }

        echo $customer_name;

    }










    /*
    |--------------------------------------------------------------------------
    | getCustomerDetails_ajax METHOD
    |--------------------------------------------------------------------------
    */
    public function getCustomerDetails_ajax(Request $request)
    {
        Session::put('customer_id_session',$request->customer_id);

        $customer_details = Customer::find($request->customer_id);


        $total_paid = BillPaymentMultiMonth::where('fk_customer_id',$request->customer_id)->sum('month_wise_paid');
        $total_amount = BillPaymentMultiMonth::where('fk_customer_id',$request->customer_id)->sum('month_wise_amount');

        $customer_due = $total_amount - $total_paid;
        // $customer_due = BillPaymentMultiMonth::where('fk_customer_id',$request->customer_id)->sum((('month_wise_amount') - ('month_wise_paid')));


        // $customer_name = $customer_details->customer_name;
        // $customer_email = $customer_details->customer_email;
        $customer_address = $customer_details->address;
        $customer_phone = $customer_details->customer_phone;
        // $customer_due = $customer_details->customer_due;
        // $bill_start_date = $customer_details->starting_date;
        // $connection_date = $customer_details->connection_date;
        $customer_id = $customer_details->customer_id;

        $fk_area_id = Area::find($customer_details->fk_area_id)->area_name;

        $fk_staff_id = Staff::where('fk_area_id',$customer_details->fk_area_id)->first()->staff_name;

        $line_category = LineCategory::find($customer_details->fk_line_id);
        $fk_line_id = $line_category->line_name;
        $line_amount = $line_category->line_amount;


        return response([
            // 'customer_name' => $customer_name,
            // 'customer_email' => $customer_email,
            'customer_address' => $customer_address,
            'customer_phone' => $customer_phone,
            'fk_line_id' => $fk_line_id,
            'fk_area_id' => $fk_area_id,
            'fk_staff_id' => $fk_staff_id,
            'line_amount' => $line_amount,
            'customer_due' => $customer_due,
            'total_paid' => $total_paid,
            // 'bill_start_date' => $bill_start_date,
            // 'connection_date' => $connection_date,
            'customer_id' => $customer_id,
        ]);


    }







    /*
    |--------------------------------------------------------------------------
    | getPaymentAmount_ajax METHOD
    |--------------------------------------------------------------------------
    */
    public function getPaymentAmounts_ajax(Request $request)
    {

        $customer_details = Customer::find(Session::get('customer_id_session'));

        $line_amount = LineCategory::find($customer_details->fk_line_id)->line_amount;



        if ($request->trans_id == 3) {

            // for Paybel
            $all_payble = $line_amount;
            // for Total Amount
            $total_amount = $line_amount;

        }
        return response([
            'all_payble' => $all_payble,
            'total_amount' => $total_amount,
        ]);



    }






    /*
    |--------------------------------------------------------------------------
    | getPaymentAmount_ajax METHOD
    |--------------------------------------------------------------------------
    */
    public function getPaymentAmount_ajax(Request $request)
    {

        $cost_amount = TransactionType::find($request->trans_id)->cost_amount;

        $customer_details = Customer::find(Session::get('customer_id_session'));

        $line_amount = LineCategory::find($customer_details->fk_line_id)->line_amount;


        $total = $cost_amount;
        $monthly_total = $cost_amount + $line_amount;


        if ($request->trans_id == 3) {

            // for Paybel
            $all_payble = "<input type='text' value='$monthly_total' class='form-control' name='payble' readonly>";
            // for Total Amount
            $total_amount = "<input type='text' class='form-control my-form padding-input total_amount' value='$monthly_total' readonly>";

        }
        else{

            // for Paybel
            $all_payble = "<input type='text' value='$total' class='form-control' name='payble' readonly>";
            // for Total Amount
            $total_amount = "<input type='text' class='form-control my-form padding-input total_amount' value='$total' readonly>";
        }

        return response([
            'all_payble' => $all_payble,
            'total_amount' => $total_amount,
        ]);



    }






    /*
    |--------------------------------------------------------------------------
    | getMonthId_ajax METHOD
    |--------------------------------------------------------------------------
    */
    public function getMonthId_ajax(Request $request)
    {

        $month_id = $request->month_id;

        echo $month_id;

    }







    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Bill Voucher
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
// return $request->all();
// die();

        // loop for checking duplicate entry

        foreach ($request->year as $key => $customer_all_details) {


            $BillPaymentMultiMonth = BillPaymentMultiMonth::where('fk_customer_id',$request->customer_id)
                                        ->where('year',$request->year[$key])
                                        ->where('month',$request->month[$key])
                                        ->exists();



            if($BillPaymentMultiMonth == 1){

                $BillPaymentMultiMonthCheck = BillPaymentMultiMonth::where('fk_customer_id',$request->customer_id)
                ->where('year',$request->year[$key])
                ->where('month',$request->month[$key])
                ->first();


                $bill_multi_month_id = $BillPaymentMultiMonthCheck->id;


                $bill_exist = $request->year[$key]."-".$request->month[$key];

                $exist_year = $request->year[$key];
                $exist_month = $request->month[$key];

                $month = $exist_month;

                $bill_multi_month = BillPaymentMultiMonth::find($bill_multi_month_id);

            // line_payment_transition_method table
            BillGenerate::find($bill_multi_month->fk_payment_transition_id)->update([
                'payment_date'=> date('Y-m-d'),
                'paid_amount'=> $bill_multi_month->month_wise_amount,
                'due_amount'=> 0,
                'status'=> 0,
            ]);


            // line_payment_multimonth_wise table
            $bill_multi_month->update([
                'month_wise_paid' => $bill_multi_month->month_wise_amount,
                'one_click' => 0,
                'receive_date' => $bill_exist,
            ]);




            }
            else{

                $date = Carbon::parse($request->date)->format('Y-m-d');

                $staff_id = Staff::where('fk_area_id',$request->area)->first()->id;

                $getPaymentOption = PaymentOption::where('status','1')->orderBy('id','asc')->value('id');

                $line_id = Customer::find($request->customer_id)->fk_line_id;
                $line_amount = LineCategory::find($line_id)->line_amount;



                // line_payment_transition_method table
                $billgenerate_id = BillGenerate::create([
                    'fk_customer_id'=> $request->customer_id,
                    'transition_id'=> 0,
                    'fk_line_transition_id'=> $getPaymentOption,
                    'fk_transition_type_id' => $request->transition_type[$key],
                    'fk_staff_id'=> $staff_id,
                    'paid_amount'=> $request->paid_amount[$key],
                    'payment_date'=> $date,
                    'discount'=> auth()->user()->type == 0 ? $request->discount_amount[$key] : 0,
                    'due_amount'=> $request->payble[$key] - ($request->paid_amount[$key] + $request->discount_amount[$key]),
                    'description'=> '',
                    'status'=> 0,
                ]);

                BillGenerate::find($billgenerate_id->id)->update([
                    'transition_id'=> date('ymd').$billgenerate_id->id,
                ]);

                // Session::put('billgenerate_id',$billgenerate_id[$key]->id);

                // line_payment_multimonth_wise table
                $multiMonth_id = BillPaymentMultiMonth::insertGetId([
                    'fk_payment_transition_id' => $billgenerate_id->id,
                    'fk_customer_id'=> $request->customer_id,
                    'fk_area_id'=> $request->area,
                    'year' => $request->year[$key],
                    'month' => $request->month[$key],
                    'fk_transition_type_id' => $request->transition_type[$key],
                    'month_wise_amount' => $line_amount,
                    'month_wise_paid' => $request->paid_amount[$key] + $request->discount_amount[$key],
                    'receive_date'=> date('Y-n', strtotime($date)),
                    'discount'=> auth()->user()->type == 0 ? $request->discount_amount[$key] : 0,
                    'one_click' => 0,
                    'created_at' => date('Y-m-d h:i:s')
                ]);


                // line_payment_due_paid
                PaymentDue::create([
                    'fk_month_wise_id' => $multiMonth_id,
                    'month_wise_amount'=> $line_amount,
                    'discount'         => auth()->user()->type == 0 ? $request->discount_amount[$key] : 0,
                    'last_due'         => 0,
                    'due_paid'         => $line_amount - $request->paid_amount[$key],
                    'due_payment_date' => $date,
                ]);


            }



        }


        $customer_details = Customer::find($request->customer_id);

        $area_name = Area::find($request->area)->area_name;

        $monthly_payment = LineCategory::find($customer_details->fk_line_id)->line_amount;

        return view('backend.billing-payment.multiple-reciept',[
            'area_name' => $area_name,
            'customer_id' => $request->customer_id,
            'customer' => $customer_details,
            'monthly_payment' => $monthly_payment,
            'invoice' => date('ynd').$request->customer_id.rand(10000,99999),
            'date' => $request->date,
            'months' => $request->month,
            'discount_amount' => $request->discount_amountd,
            'paid_amount' => $request->paid_amountd,
            'total_amount' => $request->total_amountd,
            'due_amount' => $request->total_amountd - ($request->paid_amountd + $request->discount_amountd),
        ]);





    }







    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD
    |--------------------------------------------------------------------------
    */
    public function single_destroy($id)
    {
        dd('single destroy'.$id);
    }







    /*
    |--------------------------------------------------------------------------
    | DESTROY ALL METHOD
    |--------------------------------------------------------------------------
    */
    public function destroy_all()
    {
        dd('destroy all');
    }


}
