<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\BillGenerate;
use App\Models\Customer;
use App\Models\BillPaymentMultiMonth;
use App\Models\BillPaymentMultiMonthMultiMonth;
use App\Models\LineCategory;
use App\Models\PaymentOption;
use App\Models\StaffArea;
use App\Models\TransactionType;
use App\Traits\FileSaver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class PaymentDueController extends Controller
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
        if ($request->area && $request->month && $request->year != null) {

            $year_session = Session::put('year_session',$request->year);
            $month_session = Session::put('month_session',$request->month);

            $areas = Area::get();

            $customers = Customer::with('areas')
                                 ->where('fk_area_id',$request->area)
                                 ->get();

            return view('backend.line-payment-due.index',compact('areas','customers'));
        }
        else {

            $areas = Area::get();
            $customers = 0;

            return view('backend.line-payment-due.index',compact('areas','customers'));
        }

    }




    /*
    |--------------------------------------------------------------------------
    | GENERATE METHOD
    |--------------------------------------------------------------------------
    */
    public function generate(Request $request)
    {

        $year = Session::get('year_session');
        $month = Session::get('month_session');

        $getPaymentOption = PaymentOption::where('status','1')->orderBy('id','asc')->value('id');
        $getTransitionType = TransactionType::where('status','1')->where('cost_amount',0)->value('id');

        foreach ($request->customer_id as $index => $customer) {

            $line_id = Customer::find($customer)->fk_line_id;
            $due_amount = LineCategory::find($line_id)->line_ammount;


            $area_id = Customer::find($customer)->fk_area_id;
            $staff_id = StaffArea::where('fk_area_id',$area_id)->first()->fk_staff_id;


         // line_payment_transition_method table
            $billgenerate_id = BillGenerate::insertGetId([
                'fk_customer_id'=> $customer,
                'transition_id'=> $index.$customer.date('ymd').rand(1,3),
                'fk_line_transition_id'=> $getPaymentOption,
                'fk_transition_type_id' => $getTransitionType,
                'fk_staff_id'=> $staff_id,
                'payment_date'=> date('Y-m-d'),
                'paid_amount'=> 0,
                'discount'=> 0,
                'due_amount'=> $due_amount,
                'description'=> '',
                'status'=> 1,
                'created_at' => date('Y-m-d h:i:s')
            ]);



         // line_payment_multimonth_wise table
            BillPaymentMultiMonth::create([
                'fk_payment_transition_id' => $billgenerate_id,
                'year' => $year,
                'month' => $month,
                'fk_transition_type_id' => $getTransitionType,
                'month_wise_amount' => $due_amount,
                'month_wise_paid' => 0,
                'discount' => 0,
                'one_click' => 1,
                'receive_date' => "$year-$month",
                'created_at' => date('Y-m-d h:i:s')
            ]);

        }
        return back()->with('success','Bill Generated Successfully');

    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $areas = Area::where('status',1)->get();
        $customers = Customer::where('status',1)->get();
        return view('backend.line-payment-due.create',compact('areas','customers'));
    }



    /*
    |--------------------------------------------------------------------------
    | STORE METHOD
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        BillPaymentMultiMonth::create([
            'category_name'     => $request->category_name,
            'company_name'              =>  $request->company_name,
            'category_type'             =>  $request->category_type,
            'category_status'          =>  $request->category_status,
        ]);

        Session::flash('success', 'Category Added Successfully!!');
        return redirect()->route('all-category');
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
    | EDIT METHOD
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $bill_payment = BillPaymentMultiMonth::findOrfail($id);
        return view('backend.line-payment-due.edit', compact('bill_payment'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        // return $request;
        // die();

        $category = BillPaymentMultiMonth::findOrfail($id);

        $category->update([
            'category_name'        =>  $request->category_name,
            'company_name'         =>  $request->company_name,
            'category_type'        =>  $request->category_type ,
            'category_status'      =>  $request->category_status,
        ]);

        Session::flash('success', 'Category Updated Successfully!!');
        return redirect()->route('all-category');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $category =  BillPaymentMultiMonth::findOrfail($id);

        $category->destroy($id);

        Session::flash('error', 'Category Parmanently Deleted!!');
        return redirect()->route('all-category');
    }



    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = BillPaymentMultiMonth::where('category_status',1)->where('id',$id)->update(['category_status' => 0,]);
        if($deactive){
            Session::flash('info', 'Category Status Deactivated!');
          return redirect(route('all-category'));
        }
    }



    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = BillPaymentMultiMonth::where('category_status',0)->where('id',$id)->update(['category_status' => 1,]);
        if($active){
            Session::flash('info', 'Category Status Actived!');
          return redirect(route('all-category'));
        }
     }
}
