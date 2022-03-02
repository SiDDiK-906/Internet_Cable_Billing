<?php

namespace App\Models;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $table = "area_set";
    protected $guarded = [];


    //-------------------------------------
    // Area - Customer Relation
    //-------------------------------------
    public function customers(){
        return $this->hasMany(Customer::class, 'fk_area_id');
    }




    //-------------------------------------
    // Area - Staff Relation
    //-------------------------------------
    public function Staff()
    {
        return $this->hasOne(Staff::class);
    }



    //-------------------------------------
    // Area - Staff Relation
    //-------------------------------------
    public function Staff2()
    {
        return $this->hasOne(Staff::class, 'fk_area_id');
    }




    //-------------------------------------
    // Area - BillPaymentMultiMonth Relation
    //-------------------------------------
    public function BillPaymentMultiMonth(){
        return $this->hasMany(BillPaymentMultiMonth::class, 'id');
    }




    //-------------------------------------
    // Area - BillPaymentMultiMonth Relation
    //-------------------------------------
    public function BillPaymentMultiMonthStatus(){

        return $this->hasMany(BillPaymentMultiMonth::class, 'fk_area_id')
                    ->where('year',request('year'))
                    ->where('month', request('month'))
                    ->select('id','month_wise_amount','fk_area_id','fk_transition_type_id','month_wise_paid','one_click','receive_date','fk_payment_transition_id');

    }

    public function BillPaymentMultiMonthStatusCurrent(){

        $carbon = Carbon::now();
        $current_year = $carbon->format('Y');
        $current_month = $carbon->format('n');

        return $this->hasMany(BillPaymentMultiMonth::class, 'fk_area_id')
                    ->where('year',$current_year)
                    ->where('month', $current_month)
                    ->select('id','month_wise_amount','fk_area_id','fk_transition_type_id','month_wise_paid','one_click','receive_date','fk_payment_transition_id');

    }



    //-------------------------------------
    // Area - BillPaymentMultiMonth Relation for billing status
    //-------------------------------------
    public function BillMultiMonth(){

        return $this->hasMany(BillPaymentMultiMonth::class, 'fk_area_id')
                    ->where('year', '!=' ,request('year', now(), 'Y'))
                    ->where('month', '!=' , request('month', now(), 'n'))
                    ->where('month_wise_paid',0)
                    ->select('id','month_wise_amount','fk_area_id');
    }



    //-------------------------------------
    // Area - BillPaymentMultiMonth Relation for billing status
    //-------------------------------------
    public function BillMultiMonthCurrent(){

        $carbon = Carbon::now();
        $current_year = $carbon->format('Y');
        $current_month = $carbon->format('n');

        return $this->hasMany(BillPaymentMultiMonth::class, 'fk_area_id')
                    ->where('year',$current_year)
                    ->where('month', $current_month)
                    ->where('month_wise_paid',0)
                    ->select('id','month_wise_amount','fk_area_id');
    }


}
