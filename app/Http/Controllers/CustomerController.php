<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\BillGenerate;
use App\Models\BillPaymentMultiMonth;
use App\Models\Customer;
use App\Models\LineCategory;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for all Customer
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        if (Auth()->user()->type == 0) {
            $customers = Customer::paginate(50);
            return view('backend.customers.index', compact('customers'));
        } else {
            abort(404);
        }

    }





    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Customer
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        if (Auth()->user()->type == 0) {
            $areas = Area::where('status',1)->get();
            $lineCategories = LineCategory::all();
            return view('backend.customers.create', compact('areas', 'lineCategories'));

        } else {
            abort(404);
        }


    }






    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Customer
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        if (Auth()->user()->type == 0) {
            $customer = Customer::create([
                'fk_area_id'           =>  $request->fk_area_id,
                'fk_line_id'           =>  $request->fk_line_id,
                'customer_id'          =>  $request->customer_id,
                'line_number'          =>  $request->customer_id,
                'customer_name'        =>  $request->customer_name,
                'customer_email'       =>  $request->customer_email  ?? '',
                'address'              =>  $request->address,
                'customer_phone'       =>  $request->customer_phone,
                'customer_nid'         =>  $request->customer_nid,
                'customer_due'         =>  0,
                'starting_date'        =>  $request->starting_date,
                'connection_date'      =>  $request->connection_date,
                'status'               =>  $request->status,
            ]);

            // Session::flash('success', 'Customer Added Successfully!!');
            return back()->with('success','Customer Added Successfully!');
        } else {
            abort(404);
        }

    }





    /*
    |--------------------------------------------------------------------------
    | SHOW METHOD for
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        //
    }






    /*
    |--------------------------------------------------------------------------
    | EDIT METHOD for Edit Customer
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        if (Auth()->user()->type == 0) {
            $areas = Area::where('status',1)->get();
            $lineCategories = LineCategory::all();
            $customer = Customer::where('id',$id)->first();

            // $customer = Customer::findOrfail($id);
            return view('backend.customers.edit', compact('areas' , 'customer', 'lineCategories'));
        } else {
            abort(404);
        }


    }






    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Customer
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        if (Auth()->user()->type == 0) {
            $customer = Customer::findOrfail($id);
            $customer->update([
                'fk_area_id'           =>  $request->fk_area_id,
                'fk_line_id'           =>  $request->fk_line_id,
                'customer_id'          =>  $request->customer_id,
                'line_number'          =>  $request->customer_id,
                'customer_name'        =>  $request->customer_name,
                'customer_email'       =>  $request->customer_email  ?? '',
                'address'              =>  $request->address ?? '',
                'customer_phone'       =>  $request->customer_phone,
                'customer_nid'         =>  $request->customer_nid,
                'starting_date'        =>  $request->starting_date,
                'connection_date'      =>  $request->connection_date,
            ]);


            // Session::flash('success', 'Customer Updated Successfully!!');
            return back()->with('success','Customer Updated Successfully!');
        } else {
            abort(404);
        }

    }






    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Customer
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        if (Auth()->user()->type == 0) {
            $customer =  Customer::findOrfail($id);
            $customer->destroy($id);

            // Session::flash('error', 'Customer Parmanently Deleted!!');
            return back()->with('success','Customer Parmanently Deleted!!');
        } else {
            abort(404);
        }

    }






    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Customer
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        if (Auth()->user()->type == 0) {

            $deactive = Customer::where('status',1)->where('id',$id)->update(['status' => 0,]);
            if($deactive){
                // Session::flash('info', 'Customer Status Deactivated!');
                return back()->with('success','Customer Status Actived!');
            }

        } else {
            abort(404);
        }

    }







    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Customer
    |--------------------------------------------------------------------------
    */
    public function active($id){
        if (Auth()->user()->type == 0) {

            $active = Customer::where('status',0)->where('id',$id)->update(['status' => 1,]);

            if($active){
                // Session::flash('info', 'Customer Status Actived!');
                return back()->with('success','Customer Status Actived!');
            }

        } else {
            abort(404);
        }

    }






    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for inactive_customer Customer
    |--------------------------------------------------------------------------
    */
    public function active_customer(){
        if (Auth()->user()->type == 0) {
            // $customers = $dataTable->render(Customer::where('status',1)->get());
            // $customers = Customer::where('status',1)->get();
            // return $dataTable->render('backend.customers.active', compact('customers'));
            // return $dataTable->render('backend.customers.active');

            // old
            $customers = Customer::where('status',1)
            ->select('id','fk_area_id','fk_line_id','customer_id','customer_name','address','customer_phone')
            ->paginate(30);


            $customerSearch = Customer::where('status',1)
            ->select('customer_id','customer_name','customer_phone')
            ->get();


            return view('backend.customers.active', compact('customers','customerSearch'));



        } else {
            abort(404);
        }


    }





    /*
    |--------------------------------------------------------------------------
    | ACTIVE CUSTOMER SEARCH METHOD
    |--------------------------------------------------------------------------
    */

    public function active_customer_search(Request $request){

        $customer_id = $request->input('customer_id');
        $customer_name = $request->input('customer_name');
        $customer_phone = $request->input('customer_phone');

        if (Auth()->user()->type == 0) {


            // $customers = Customer::where('customer_id',$customer_id)
                //                 ->where('customer_name',$customer_name)
                //                 ->where('customer_phone',$customer_phone)
                //                 ->paginate(20);
            $customers = Customer::when(request()->filled('customer_id'), function($qr) use($request) {
                                            $qr->where('customer_id',$request->customer_id);

                                         })->when(request()->filled('customer_name'), function($qr) use($request) {
                                            $qr->where('customer_name',$request->customer_name);

                                         })->when(request()->filled('customer_phone'), function($qr) use($request) {
                                            $qr->where('customer_phone',$request->customer_phone);
                                         })->paginate(50);


            $customerSearch = Customer::where('status',1)
            ->select('customer_id','customer_name','customer_phone')
            ->get();
            return view('backend.customers.active', compact('customers','customerSearch'));

        } else {
            abort(404);
        }

    }



    /*
    |--------------------------------------------------------------------------
    | INACTIVE CUSTOMER SEARCH METHOD
    |--------------------------------------------------------------------------
    */

    public function inactive_customer_search(Request $request){

        $customer_id = $request->customer_id;
        $customer_name = $request->customer_name;
        $customer_phone = $request->customer_phone;

        if (Auth()->user()->type == 0) {

            $customers = Customer::when(request()->filled('customer_id'), function($qr) use($request) {
                $qr->where('customer_id',$request->customer_id);

             })->when(request()->filled('customer_name'), function($qr) use($request) {
                $qr->where('customer_name',$request->customer_name);

             })->when(request()->filled('customer_phone'), function($qr) use($request) {
                $qr->where('customer_phone',$request->customer_phone);
             })->paginate(50);


             $customerSearch = Customer::where('status',0)
             ->select('customer_id','customer_name','customer_phone')
             ->get();
             return view('backend.customers.inactive', compact('customers','customerSearch'));

        } else {
            abort(404);
        }

    }









    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for active_customer in staff
    |--------------------------------------------------------------------------
    */
    public function active_customer_staff($user_id){

        $area_id = Staff::find(User::find($user_id)->fk_staff_id)->fk_area_id;


        if ($area_id != NULL) {

            $customers = Customer::where('fk_area_id',$area_id)->where('status',1)->select('id','fk_area_id','fk_line_id','customer_id','customer_name','address','customer_phone')->paginate(30);
            return view('backend.customers.active', compact('customers'));

        }
        else {
            return back()->with('error', 'You dont have any "Staff" Credential [Talk to Owner of this site]');
            // echo "<h4 class='text-center'>You dont have any credential in Staff table [Talk to Developer or Owner of this site]</h4>";
        }




    }







    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for inactive_customer in staff
    |--------------------------------------------------------------------------
    */
    public function inactive_customer_staff($user_id){

        $area_id = Staff::find(User::find($user_id)->fk_staff_id)->fk_area_id;


        if ($area_id != NULL) {

            $customers = Customer::where('fk_area_id',$area_id)->where('status',0)->select('id','fk_area_id','fk_line_id','customer_id','customer_name','address','customer_phone')->paginate(30);
            return view('backend.customers.active', compact('customers'));

        }
        else {
            return back()->with('error', 'You dont have any "Staff" Credential [Talk to Owner of this site]');
            // echo "<h4 class='text-center'>You dont have any credential in Staff table [Talk to Developer or Owner of this site]</h4>";
        }




    }





    /*
    |--------------------------------------------------------------------------
    | INACTIVE METHOD for inactive_customer Customer
    |--------------------------------------------------------------------------
    */

    public function inactive_customer(){
        if (Auth()->user()->type == 0) {
            $customers = Customer::where('status',0)->select('id','fk_area_id','fk_line_id','customer_id','customer_name','address','customer_phone')->paginate(30);

            $customerSearch = Customer::where('status',0)
            ->select('customer_id','customer_name','customer_phone')
            ->get();


            return view('backend.customers.inactive', compact('customers','customerSearch'));




        } else {
            abort(404);
        }


    }





    /*
    |--------------------------------------------------------------------------
    | TRANSACTION METHOD for transaction Customer
    |--------------------------------------------------------------------------
    */
    public function transaction($id){

        $total_bills = BillPaymentMultiMonth::with('customer')->where('fk_customer_id',$id)->orderBy('id','desc')->get();

        return view('backend.customers.transaction', compact('total_bills'));

    }
}
