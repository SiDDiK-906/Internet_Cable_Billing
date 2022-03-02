<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SmsController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Client
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $clients = Client::all();
        return view('backend.clients.index', compact('clients'));
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Client
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.clients.create');
    }




    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Client
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $client = Client::create([
            'client_id'        =>  $request->client_id,
            'client_name'       =>  $request->client_name,
            'mobile_no'         =>  $request->mobile_no,
            'address'           =>  $request->address,
            'email_id'          =>  $request->email_id,
            'client_type'       =>  $request->client_type,
            'company_name'      =>  $request->company_name,

        ]);

        Session::flash('success', 'Client Added Successfully!!');
        return redirect()->route('all-client');
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
    | EDIT METHOD for Edit Client
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $client = Client::findOrfail($id);
        return view('backend.clients.edit', compact('client'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Client
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $client = Client::findOrfail($id);


        $client->update([
            'client_id'         =>  $request->client_id ,
            'client_name'       =>  $request->client_name,
            'mobile_no'         =>  $request->mobile_no,
            'address'           =>  $request->address,
            'email_id'          =>  $request->email_id,
            'client_type'       =>  $request->client_type,
            'company_name'      =>  $request->company_name,
        ]);


        Session::flash('success', 'Client Updated Successfully!!');
        return redirect()->route('all-client');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Client
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $client =  Client::findOrfail($id);
        $client->destroy($id);

        Session::flash('error', 'Client Parmanently Deleted!!');
        return redirect()->route('all-client');
    }





    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Client
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = Client::where('client_status',1)->where('id',$id)->update(['client_status' => 0,]);
        if($deactive){
            Session::flash('info', 'Client Status  Deactivated!');
          return redirect(route('all-client'));
        }
    }




    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Client
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = Client::where('client_status',0)->where('id',$id)->update(['client_status' => 1,]);
        if($active){
            Session::flash('info', 'Client Status Actived!');
          return redirect(route('all-client'));
        }
     }
}
