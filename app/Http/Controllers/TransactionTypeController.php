<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Session;

class TransactionTypeController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }





    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Transaction Type
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $transactionTypes = TransactionType::all();
        return view('backend.transaction-types.index', compact('transactionTypes'));
    }






    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Transaction Type
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.transaction-types.create');
    }






    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Transaction Type
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $transactionType = TransactionType::create([
            'cost_category_name'     =>  $request->cost_category_name,
            'cost_amount'            =>  $request->cost_amount,
            'description'            =>  $request->description,
            'status'                 =>  1,
        ]);

        Session::flash('success', 'Transaction Category Name Added Successfully!!');
        return redirect()->route('all-transaction-type');
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
    | EDIT METHOD for Edit Transaction Type
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $transactionType = TransactionType::findOrfail($id);
        return view('backend.transaction-types.edit', compact('transactionType'));
    }







    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Transaction Type
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $transactionType = TransactionType::findOrfail($id);
        $transactionType->update([
            'cost_category_name'     =>  $request->cost_category_name,
            'cost_amount'            =>  $request->cost_amount,
            'description'            =>  $request->description,
        ]);

        Session::flash('success', 'Transaction Category Name Updated Successfully!!');
        return redirect()->route('all-transaction-type');
    }







    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Transaction Type
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $transactionType =  TransactionType::findOrfail($id);
        $transactionType->destroy($id);

        Session::flash('error', 'Transaction Category Name Parmanently Deleted!!');
        return redirect()->route('all-transaction-type');
    }







    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Transaction Type
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = TransactionType::where('status',1)->where('id',$id)->update(['status' => 0,]);
        if($deactive){
            Session::flash('info', 'Transaction Category Name Status  Deactivated!');
          return redirect(route('all-transaction-type'));
        }
    }






    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Transaction Type
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = TransactionType::where('status',0)->where('id',$id)->update(['status' => 1,]);
        if($active){
            Session::flash('info', 'Transaction Category Name Status Actived!');
          return redirect(route('all-transaction-type'));
        }
     }
}
