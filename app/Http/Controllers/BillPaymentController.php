<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\BillGenerate;
use App\Models\BillPaymentMultiMonth;
use App\Models\Customer;
use App\Models\LineCategory;
use App\Models\Staff;
use App\Models\TransactionType;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BillPaymentController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | view_all_paid_bill METHOD
    |--------------------------------------------------------------------------
    */
    public function view_all_paid_bill(){

        // return
        $customers = Customer::select('customer_name as name', 'customer_id', 'id')->get();


        $paid_bills = BillGenerate::with('linePayTranMethods')->where('due_amount','==',0)
                            ->orderBy('id','desc')
                            ->paginate(30);

        return view('backend.billing-payment.paid',compact('paid_bills', 'customers'));

    }





    /*
    |--------------------------------------------------------------------------
    | view_all_due_bill METHOD
    |--------------------------------------------------------------------------
    */
    public function view_all_due_bill(){

        $customers = Customer::select('customer_name as name', 'customer_id', 'id')->get();

        $due_bills = BillGenerate::with('linePayTranMethods')->where('due_amount','!=',0)
                            ->orderBy('id','desc')
                            ->paginate(30);

        return view('backend.billing-payment.due',compact('due_bills', 'customers'));

    }




    /*
    |--------------------------------------------------------------------------
    | edit_payment METHOD
    |--------------------------------------------------------------------------
    */
    public function edit_payment($id){

        $areas = Area::where('status',1)->get();
        $transition_types = TransactionType::get();


        $bill_month_wise = BillPaymentMultiMonth::where('fk_payment_transition_id',$id)->first();

        $bill_generate = BillGenerate::find($id);

        $customer = Customer::find($bill_generate->fk_customer_id);

        $line_info = LineCategory::find($customer->fk_line_id);

        $area_info = Area::find($bill_month_wise->fk_area_id);

        $staff_info = Staff::where('fk_area_id',$area_info->id)->first();

        // return $area_info;

        $bill_generate_id = $id;
        $customer_name = $customer->customer_name;

        // die();

        return view('backend.billing-payment.edit',compact('areas','line_info','area_info','staff_info','bill_generate','bill_month_wise','transition_types','bill_generate_id','customer','customer_name'));

    }





    /*
    |--------------------------------------------------------------------------
    | update_payment METHOD
    |--------------------------------------------------------------------------
    */
    public function update_payment(Request $request,$id){

        $bill_generate_id = $id;

        $bill_multi_month = BillPaymentMultiMonth::where('fk_payment_transition_id',$bill_generate_id)->first();

        $bill_generate = BillGenerate::find($bill_generate_id);


        $staff_id = Staff::where('fk_area_id',$request->area)->first()->id;

        // updating customer due

        // line_payment_transition_method table
        $bill_generate->update([
            'fk_customer_id'=> $request->customer_id,
            'fk_transition_type_id' => $request->transition_type,
            'fk_staff_id'=> $staff_id,
            'paid_amount'=> $request->paid_amount,
            'discount'=> $request->discount_amount,
            'due_amount'=> $request->payble - $request->paid_amount,
            'payment_date'=> $request->date,
        ]);


        // line_payment_multimonth_wise table
        $bill_multi_month->update([
            'fk_customer_id'=> $request->customer_id,
            'fk_area_id' => $request->area,
            'year' => $request->year,
            'month' => $request->month,
            'fk_transition_type_id' => $request->transition_type,
            'month_wise_amount' => $request->payble,
            'month_wise_paid' => $request->paid_amount,
            'discount' => $request->discount_amount,
            'receive_date' => date('Y-n',strtotime($request->date)),
        ]);


        return redirect('/view-all-paid-bill-payment')->with('success','Data Updated Successfully');
    }





    /*
    |--------------------------------------------------------------------------
    | destroy_payment METHOD
    |--------------------------------------------------------------------------
    */
    public function destroy_payment($id){
        try {
            $bill_multi_month = BillPaymentMultiMonth::where('fk_payment_transition_id',$id)->first();

            $bill = BillGenerate::find($id);

            $bill_multi_month->PaymentDue()->delete();

            $bill->linePayTranMethods()->delete();

            $bill->delete();

            return back()->with('success','Deleted!');


        } catch(\Exception $ex) {
            return redirect()->back()->withError($ex->getMessage());
        }




    }



    /*
    |--------------------------------------------------------------------------
    | due_search_bill_payment METHOD
    |--------------------------------------------------------------------------
    */
    public function due_search_bill_payment(Request $request){


        $c_id = $request->input('customer_id');
        $c_name = $request->input('customer_name');
        $date        = $request->input('payment_date');


        $customer_id = Customer::find($c_id)->customer_id;
        $customer_name = Customer::find($c_name)->customer_name;




        if (Auth()->user()->type == 0) {

            if( isset($c_id) & !isset($c_name) & !isset($date) ){
                $paid_bills = BillGenerate::where('fk_customer_id',$c_id)->where('paid_amount',0)->get();
                
            }

            elseif( isset($c_name) & !isset($date) & !isset($c_id) ){
                $paid_bills = BillGenerate::where('fk_customer_id',$c_name)->where('paid_amount',0)->get();
                
            }

            elseif( isset($date) & !isset($c_name) & !isset($c_id) ){
                $paid_bills = BillGenerate::where('payment_date',$date)->where('paid_amount',0)->get();
                
            }



            elseif( isset($c_id) & isset($c_name) & !isset($date) ){
                $paid_bills = BillGenerate::where('fk_customer_id',$c_id)->where('fk_customer_id',$c_name)->where('paid_amount',0)->get();
                
            }

            elseif( isset($c_name) & isset($date) & !isset($c_id) ){
                $paid_bills = BillGenerate::where('payment_date',$date)->where('fk_customer_id',$c_name)->where('paid_amount',0)->get();
                
            }

            elseif( isset($date) & !isset($c_name) & isset($c_id) ){
                $paid_bills = BillGenerate::where('payment_date',$date)->where('fk_customer_id',$c_id)->where('paid_amount',0)->get();
                
            }

            else{
                $paid_bills = BillGenerate::where('fk_customer_id',$c_id)->where('payment_date',$date)->where('fk_customer_id',$c_name)->where('paid_amount',0)->get();
                
            }



            $customers = Customer::select('customer_name as name', 'customer_id', 'id')->get();
            return view('backend.billing-payment.due-search',compact('paid_bills','customers'));

        } else {
            abort(404);
        }



    }



    /*
    |--------------------------------------------------------------------------
    | paid_search_bill_payment METHOD
    |--------------------------------------------------------------------------
    */
    public function paid_search_bill_payment(Request $request){


        $c_id = $request->input('customer_id');
        $c_name = $request->input('customer_name');
        $date        = $request->input('payment_date');


        $customer_id = Customer::find($c_id)->customer_id;
        $customer_name = Customer::find($c_id)->customer_name;



        if (Auth()->user()->type == 0) {

            if( isset($c_id) & !isset($c_name) & !isset($date) ){
                $paid_bills = BillGenerate::where('fk_customer_id',$c_id)->where('paid_amount','!=',0)->get();
            }

            elseif( isset($c_name) & !isset($date) & !isset($c_id) ){
                $paid_bills = BillGenerate::where('fk_customer_id',$c_name)->where('paid_amount','!=',0)->get();
            }

            elseif( isset($date) & !isset($c_name) & !isset($c_id) ){
                $paid_bills = BillGenerate::where('payment_date',$date)->where('paid_amount','!=',0)->get();
            }



            elseif( isset($c_id) & isset($c_name) & !isset($date) ){
                $paid_bills = BillGenerate::where('fk_customer_id',$c_id)->where('fk_customer_id',$c_name)->where('paid_amount','!=',0)->get();
            }

            elseif( isset($c_name) & isset($date) & !isset($c_id) ){
                $paid_bills = BillGenerate::where('payment_date',$date)->where('fk_customer_id',$c_name)->where('paid_amount','!=',0)->get();
            }

            elseif( isset($date) & !isset($c_name) & isset($c_id) ){
                $paid_bills = BillGenerate::where('payment_date',$date)->where('fk_customer_id',$c_id)->where('paid_amount','!=',0)->get();
            }

            else{
                $paid_bills = BillGenerate::where('fk_customer_id',$c_id)->where('payment_date',$date)->where('fk_customer_id',$c_name)->where('paid_amount','!=',0)->get();
            }



            $customers = Customer::select('customer_name as name', 'customer_id', 'id')->get();
            return view('backend.billing-payment.paid-search',compact('paid_bills','customers'));

        } else {
            abort(404);
        }

    }




    /*
    |--------------------------------------------------------------------------
    | MAKE VOCHER METHOD
    |--------------------------------------------------------------------------
    */
    public function make_voucher($id)
    {
        $bill_generate = BillGenerate::find($id);
        $bill_month_wise = BillPaymentMultiMonth::where('fk_payment_transition_id',$id)->first()->month;
        $customer = Customer::find($bill_generate->fk_customer_id);
        $area_name = Area::find($customer->fk_area_id)->area_name;
        $invoice = date('Ymd').$id;
        $monthly_payment = LineCategory::find($customer->fk_line_id)->line_amount;
        return view('backend.billing-payment.reciept',compact('bill_generate','bill_month_wise','customer','invoice','area_name','monthly_payment'));

    }





    /*
    |--------------------------------------------------------------------------
    | MAKE MULTIPLE VOCHER METHOD
    |--------------------------------------------------------------------------
    */
    public function make_multiple_voucher(
        $area_id,
        $customer_id,
        $customer,
        $bill_month_wise,
        $date,
        $month,
        $discount_amount,
        $paid_amount,
        $total_amount,
        $due_amount
        )
    {

        return $total_amount;
        die();

        return view('backend.billing-payment.multiple-reciept',[
            'area_id' => $area_id,
            'customer_id' => $customer_id,
            'customer' => $customer,
            'bill_month_wise' => $bill_month_wise,
            'date' => $date,
            'month' => $month,
            'discount_amount' => $discount_amount,
            'paid_amount' => $paid_amount,
            'total_amount' => $total_amount,
            'due_amount' => $due_amount,
        ]);

    }

}
