<?php

namespace App\Http\Controllers;

use App\Traits\FileSaver;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompanyInfoController extends Controller
{
    use FileSaver;

    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Company Info
    |--------------------------------------------------------------------------
    */
    public function index(){
        $companyInfo = CompanyInfo::first();
        return view('backend.company-infos.index', compact('companyInfo'));
    }






    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Company Info
    |--------------------------------------------------------------------------
    */
    public function store(Request $request){


        $companyInfo = CompanyInfo::first();

        $companyInfo->update([

            'company_name'           => $request->company_name,
            'web_address'            => $request->web_address,
            'company_address'        => $request->company_address,
            'company_email'          => $request->company_email,
            'company_phone'          => $request->company_phone,
            'company_logo'           => $companyInfo->company_logo ?? '',
            'company_icon'           => $companyInfo->company_icon ?? '',
            'fb_page_link'           => $request->fb_page_link,

        ]);

        $this->uploadFileWithResize($request->company_logo, $companyInfo, 'company_logo', 'company-info/logo', 300, 300);
        $this->uploadFileWithResize($request->company_icon, $companyInfo, 'company_icon', 'company-info/icon', 500, 500);

        Session::flash('success', 'Successfully Company Info Updated!');

        return redirect()->back();
    }
}
