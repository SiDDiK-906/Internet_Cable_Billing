<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Staff;
use App\Models\User;
use App\Traits\FileSaver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use FileSaver;

    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }





    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading User
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }







    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading User
    |--------------------------------------------------------------------------
    */
    public function all_admin()
    {
        $users = User::where('type',0)->get();
        return view('backend.users.index', compact('users'));
    }






    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create User
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $areas = Area::where('status',1)->get();
        return view('backend.users.create',compact('areas'));
    }







    /*
    |--------------------------------------------------------------------------
    | TYPE METHOD for Create User
    |--------------------------------------------------------------------------
    */
    public function getTypeId_ajax(Request $request)
    {
        // For Admin
        if ($request->id == 0) {

        }
        // For Staff
        else {

        }


    }






    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store User
    |--------------------------------------------------------------------------
    */
    public function store(Request $request , $id)
    {
        //For Admin
        if ($id == 0) {

            if($request->file('profile_image') != NULL){

                $user = User::create([
                    'profile_image'     => 'user-profile-image.png',
                    'name'              =>  $request->name,
                    'email'             =>  $request->email,
                    'password'          =>  Hash::make($request->password),
                    'phone_number'      =>  $request->phone_number,
                    'gender'            =>  $request->gender,
                    'address'           =>  $request->address,
                    'type'              =>  0,
                    'status'            =>  1,
                ]);

                $this->uploadFileWithResize($request->profile_image, $user, 'profile_image', 'users/images',  500, 600);
            }
            else{
                $user = User::create([
                    'name'              =>  $request->name,
                    'email'             =>  $request->email,
                    'password'          =>  Hash::make($request->password),
                    'phone_number'      =>  $request->phone_number,
                    'gender'            =>  $request->gender,
                    'address'           =>  $request->address,
                    'type'              =>  0,
                    'status'            =>  1,
                ]);
            }

            return back()->with('success', 'User Added Successfully!!');

        }

        // For Staff
        else {

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
                        'type'              =>  1,
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
                        'type'              =>  1,
                        'created_by'        =>  Auth()->user()->email,
                    ]);
                }

            return back()->with('success', 'User Added Successfully!!');
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
    | EDIT METHOD for Edit User
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('backend.users.edit', compact('user'));
    }






    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update User
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $userImage = User::select('profile_image')->whereId($request->id)->first();

        $user->update([
            'profile_image'     =>  $userImage->profile_image ?? 'user-profile-image.png',
            'name'              =>  $request->name,
            'email'             =>  $request->email,
            'password'          =>  Hash::make($request->password) ,
            'phone_number'      =>  $request->phone_number,
            'gender'            =>  $request->gender,
            'address'           =>  $request->address,
        ]);

        $this->uploadFileWithResize($request->profile_image, $user, 'profile_image', 'users/images', 500, 600);
        Session::flash('success', 'User Updated Successfully!!');
        return redirect()->route('all-user');
    }






    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy User
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $user =  User::findOrfail($id);

        if(file_exists($user->profile_image))
        {
            unlink($user->profile_image);
        }
        $user->destroy($id);

        Session::flash('error', 'User Parmanently Deleted!!');
        return redirect()->route('all-user');
    }





    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive User
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = User::where('status',1)->where('id',$id)->update(['status' => 0,]);
        if($deactive){
            Session::flash('info', 'User Status Deactivated!');
          return redirect(route('all-user'));
        }
    }







    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active User
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = User::where('status',0)->where('id',$id)->update(['status' => 1,]);
        if($active){
            Session::flash('info', 'User Status Actived!');
          return redirect(route('all-user'));
        }
     }
}
