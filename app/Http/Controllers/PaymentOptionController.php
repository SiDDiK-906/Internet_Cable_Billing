<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentOption;
use Illuminate\Support\Facades\Session;

class PaymentOptionController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }

    // index
    public function index()
    {
        $paymentOptions = PaymentOption::all();
        return view('backend.payment-options.index', compact('paymentOptions'));
    }






    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Payment Option
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.payment-options.create');
    }







    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Payment Option
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $paymentOption = PaymentOption::create([
            'name'         =>  $request->name,
            'description'  =>  $request->description,
            'status'       =>  1,
        ]);

        Session::flash('success', 'Payment Option Added Successfully!!');
        return redirect()->route('all-payment-option');
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
    | EDIT METHOD for Edit Payment Option
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $paymentOption = PaymentOption::findOrfail($id);
        return view('backend.payment-options.edit', compact('paymentOption'));
    }







    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Payment Option
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $paymentOption = PaymentOption::findOrfail($id);
        $paymentOption->update([
            'name'         =>  $request->name,
            'description'  =>  $request->description,
        ]);

        Session::flash('success', 'Payment Option Updated Successfully!!');
        return redirect()->route('all-payment-option');
    }







    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Payment Option
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $paymentOption =  PaymentOption::findOrfail($id);
        $paymentOption->destroy($id);

        Session::flash('error', 'Payment Option Parmanently Deleted!!');
        return redirect()->route('all-payment-option');
    }







    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Payment Option
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = PaymentOption::where('status',1)->where('id',$id)->update(['status' => 0,]);
        if($deactive){
            Session::flash('info', 'Payment Option Status  Deactivated!');
          return redirect(route('all-payment-option'));
        }
    }







    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Payment Option
    |--------------------------------------------------------------------------
    */

    public function active($id){
        $active = PaymentOption::where('status',0)->where('id',$id)->update(['status' => 1,]);
        if($active){
            Session::flash('info', 'Payment Option Status Actived!');
          return redirect(route('all-payment-option'));
        }
     }
}
