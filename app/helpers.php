<?php

use App\Models\Area;
use App\Models\BillGenerate;
use App\Models\BillPaymentMultiMonth;
use App\Models\Staff;
use App\Models\Customer;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Contracts\Session\Session;




function customer_id_check($customer_id, $area_id, $year, $month_number){

    $area_ids = $area_id;
    $years = $year;
    $month_numbers = $month_number;
    $custom_id = $customer_id;


    $BillMultiMonths = BillPaymentMultiMonth::where('fk_area_id', $area_ids)
    ->where('year', $years)
    ->where('month',  $month_numbers)
    ->where('fk_customer_id',  $customer_id)
    ->select('id','fk_customer_id')
    ->exists();



    return $BillMultiMonths;




}



/*
|--------------------------------------------------------------------------
| ALL ACTIVE CUSTOMER HELPER FUNCTION
|--------------------------------------------------------------------------
*/
function customer_total_due($id){

    $dues = BillPaymentMultiMonth::where('fk_customer_id',$id)
                                 ->where('one_click',1)
                                 ->sum('month_wise_amount');
    return $dues;
}





/*
|--------------------------------------------------------------------------
| ALL ACTIVE CUSTOMER HELPER FUNCTION
|--------------------------------------------------------------------------
*/
function payment_date_helpers($id){

    $format = date('Y-n', strtotime(BillGenerate::find($id)->payment_date));

    return $format;
}



/*
|--------------------------------------------------------------------------
| ALL ACTIVE CUSTOMER HELPER FUNCTION
|--------------------------------------------------------------------------
*/
function all_active_customers(){

    return Customer::where('status',1)->get()->count();

}



/*
|--------------------------------------------------------------------------
| AREA WISE ACTIVE CUSTOMER HELPER FUNCTION
|--------------------------------------------------------------------------
*/
function active_customers_area($area_id){

    return Customer::where('fk_area_id',$area_id)->where('status',1)->get('id')->count();

}





/*
|--------------------------------------------------------------------------
| AREA WISE ACTIVE CUSTOMER HELPER FUNCTION
|--------------------------------------------------------------------------
*/
function active_customers_staff($staff_id){

    $area_id = Staff::find($staff_id)->fk_area_id;
    return Customer::where('fk_area_id',$area_id)->where('status',1)->get('id')->count();

}








/*
|--------------------------------------------------------------------------
| Single Customer
|--------------------------------------------------------------------------
*/
function customers_help($customer_id){

    return Customer::find($customer_id);

}






/*
|--------------------------------------------------------------------------
| for staff id checking
|--------------------------------------------------------------------------
*/

function staff_id_check($user_id){

    return Staff::find(User::find($user_id)->fk_staff_id)->fk_area_id;

}






/*
|--------------------------------------------------------------------------
| used in month wise table
|--------------------------------------------------------------------------
*/
function customers_area($area_id){

    return Customer::where('fk_area_id',$area_id)->get();

}








// used in month wise table
function staff_area($staff_id){

    return App\Models\StaffArea::where('fk_staff_id',$staff_id)->get('fk_area_id');

}





function staff_help($area_id){

    return Staff::find(App\Models\StaffArea::where('fk_area_id',$area_id)->first()->fk_staff_id);

}


// billing status

function recover_bill($area_id){

    return BillPaymentMultiMonth::where('fk_area_id',$area_id)->get();

}



// for role management in staff

function role($fk_staff_id){

    $area_id = Staff::find($fk_staff_id)->fk_area_id;
    return Area::find($area_id);

}




// Monthly Bill

function monthly_bill($area_id, $year, $month){

    return BillPaymentMultiMonth::where('fk_area_id',$area_id)
                         ->where('year',$year)
                         ->where('month',$month)
                         ->get();

}


// Staff id
function staff_id($area_id){

    return Staff::where('fk_area_id',$area_id)->first();

}



function customers_count($area_id){

    return Customer::where('fk_area_id',$area_id)->where('status',1)->get();

}




function recoverable_bill($area_id){

    return Customer::where('fk_area_id',$area_id)->where('status',1)->get('id');

}







function cost_category_name($id){

    return TransactionType::find($id);

}



