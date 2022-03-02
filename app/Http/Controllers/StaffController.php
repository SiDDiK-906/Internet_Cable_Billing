<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\Staff;
use App\Traits\FileSaver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    use FileSaver;

    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }





    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Staff
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $staffs = Staff::all();
        return view('backend.staffs.index', compact('staffs'));
    }







    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create Staff
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $areas = Area::where('status',1)->get();
        return view('backend.staffs.create', compact('areas'));
    }







    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Staff
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        if(isset($request->type)){

            //staff
            $staff = Staff::insertGetId([
                'fk_area_id'              =>  $request->area,
                'staff_name'              =>  $request->staff_name,
                'staff_email'             =>  $request->staff_email,
                'password'                =>  Hash::make($request->password),
                'staff_phone_no'          =>  $request->staff_phone_no,
                'staff_address'           =>  $request->staff_address,
                'staff_status'            =>  1,
                'created_at'              =>  Carbon::now(),
            ]);


            if($request->file('staff_profile') != NULL){
                // for user table
                $user = User::create([
                    'profile_image'     => 'default.png',
                    'fk_staff_id'       =>  $staff,
                    'name'              =>  $request->staff_name,
                    'email'             =>  $request->staff_email,
                    'password'          =>  Hash::make($request->password),
                    'phone_number'      =>  $request->staff_phone_no,
                    'address'           =>  $request->staff_address,
                    'status'            =>  1,
                    'type'              =>  $request->type,
                    'created_by'        =>  Auth()->user()->email,
                ]);

                $this->uploadFileWithResize($request->staff_profile, $user, 'profile_image', 'users/images',  500, 600);
            }
            else{
                // for user table
                $user = User::create([
                    'fk_staff_id'       =>  $staff,
                    'name'              =>  $request->staff_name,
                    'email'             =>  $request->staff_email,
                    'password'          =>  Hash::make($request->password),
                    'phone_number'      =>  $request->staff_phone_no,
                    'address'           =>  $request->staff_address,
                    'status'            =>  1,
                    'type'              =>  $request->type,
                    'created_by'        =>  Auth()->user()->email,
                ]);
            }
        }
        else{

            //staff
            $staff = Staff::insertGetId([
                'fk_area_id'              =>  $request->area,
                'staff_name'              =>  $request->staff_name,
                'staff_email'             =>  $request->staff_email,
                'password'                =>  Hash::make($request->password),
                'staff_phone_no'          =>  $request->staff_phone_no,
                'staff_address'           =>  $request->staff_address,
                'staff_status'            =>  1,
                'created_at'              =>  Carbon::now(),
            ]);

            if($request->file('staff_profile') != NULL){
                // for user table
                $user = User::create([
                    'profile_image'     => 'default.png',
                    'fk_staff_id'       =>  $staff,
                    'name'              =>  $request->staff_name,
                    'email'             =>  $request->staff_email,
                    'password'          =>  Hash::make($request->password),
                    'phone_number'      =>  $request->staff_phone_no,
                    'address'           =>  $request->staff_address,
                    'status'            =>  1,
                    'type'              =>  $request->type,
                    'created_by'        =>  Auth()->user()->email,
                ]);

                $this->uploadFileWithResize($request->staff_profile, $user, 'profile_image', 'users/images',  500, 600);
            }
            else{
                // for user table
                $user = User::create([
                    'fk_staff_id'       =>  $staff,
                    'name'              =>  $request->staff_name,
                    'email'             =>  $request->staff_email,
                    'password'          =>  Hash::make($request->password),
                    'phone_number'      =>  $request->staff_phone_no,
                    'address'           =>  $request->staff_address,
                    'status'            =>  1,
                    'type'              =>  $request->type,
                    'created_by'        =>  Auth()->user()->email,
                ]);
            }
        }

        Session::flash('success', 'Staff & User Added Successfully!!');
        return redirect()->route('all-staff');
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
    | EDIT METHOD for Edit Staff
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $staff = Staff::findOrfail($id);
        return view('backend.staffs.edit', compact('staff'));
    }







    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Staff
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {

        $staff = Staff::findOrfail($id);
        $staff->update([
            'staff_name'              =>  $request->staff_name,
            'staff_email'             =>  $request->staff_email,
            'password'                =>  Hash::make($request->password),
            'staff_phone_no'          =>  $request->staff_phone_no,
            'staff_address'           =>  $request->staff_address,
        ]);

        $user = User::where('fk_staff_id', $staff->id)->first();

        $user->update([
            'profile_image'     =>  $user->profile_image ?? 'default.png',
            'name'              =>  $request->staff_name,
            'email'             =>  $request->staff_email,
            'password'          =>  Hash::make($request->password),
            'phone_number'      =>  $request->staff_phone_no,
            'address'           =>  $request->staff_address,
        ]);

        $this->uploadFileWithResize($request->staff_profile, $user, 'profile_image', 'users/images',  500, 600);

        Session::flash('success', 'Staff & User Updated Successfully!!');
        return redirect()->route('all-staff');
    }







    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Staff
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $staff =  Staff::findOrfail($id);

        if(file_exists($staff->staff_profile))
        {
            unlink($staff->staff_profile);
        }
        $staff->destroy($id);

        Session::flash('error', 'Staff Parmanently Deleted!!');
        return redirect()->route('all-staff');
    }







    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Staff
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = Staff::where('staff_status',1)->where('id',$id)->update(['staff_status' => 0,]);
        if($deactive){
            Session::flash('info', 'Staff Status Deactivated!');
          return redirect(route('all-staff'));
        }
    }






    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Staff
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = Staff::where('staff_status',0)->where('id',$id)->update(['staff_status' => 1,]);
        if($active){
            Session::flash('info', 'Staff Status Actived!');
          return redirect(route('all-staff'));
        }
     }
}
