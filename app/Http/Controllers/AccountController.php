<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\BillPaymentMultiMonth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Account
    |--------------------------------------------------------------------------
    */
    public function index()
    {

        $accounts = Account::all();
        return view('backend.accounts.index', compact('accounts'));

    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Account
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.accounts.create');
    }




    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Account
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $account = Account::create([
            'account_name'          =>  $request->account_name,
            'current_balance'       =>  $request->current_balance,
            'account_description'   =>  $request->account_description,
            'company_name'          =>  $request->company_name,
            'account_status'        =>  1,
            'created_by'            =>  $request->created_by,
            'updated_by'            =>  $request->updated_by,
        ]);

        Session::flash('success', 'Account Added Successfully!!');
        return redirect()->route('all-account');
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
    | EDIT METHOD for Edit Account
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $account = Account::findOrfail($id);
        return view('backend.accounts.edit', compact('account'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Account
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $account = Account::findOrfail($id);


        $account->update([
            'account_name'          =>  $request->account_name,
            'current_balance'       =>  $request->current_balance,
            'account_description'   =>  $request->account_description,
            'company_name'          =>  $request->company_name,
            'created_by'            =>  $request->created_by,
            'updated_by'            =>  $request->updated_by,
        ]);


        Session::flash('success', 'Account Updated Successfully!!');
        return redirect()->route('all-account');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Account
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $account =  Account::findOrfail($id);
        $account->destroy($id);

        Session::flash('error', 'Account Parmanently Deleted!!');
        return redirect()->route('all-account');
    }





    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Account
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = Account::where('account_status',1)->where('id',$id)->update(['account_status' => 0,]);
        if($deactive){
            Session::flash('info', 'Account Status  Deactivated!');
          return redirect(route('all-account'));
        }
    }




    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Account
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = Account::where('account_status',0)->where('id',$id)->update(['account_status' => 1,]);
        if($active){
            Session::flash('info', 'Account Status Actived!');
          return redirect(route('all-account'));
        }
     }
}
