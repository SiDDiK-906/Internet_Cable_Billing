<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillPaymentMultiMonth extends Model
{
    use HasFactory;

    protected $table = "line_payment_multimonth_wise";

    protected $guarded = [];


    public function PaymentDue()
    {
        return $this->hasOne(PaymentDue::class, 'fk_month_wise_id');
    }





    public function line_transition_type()
    {
        return $this->belongsTo(TransactionType::class, 'fk_transition_type_id');
    }





    //  to line_payment_transition_method table
    public function BillGenerate()
    {
        return $this->belongsTo(BillGenerate::class,'id');
    }



    //  used in index.blade.php of month wise table
    public function Bill_Generate()
    {
        return $this->belongsTo(BillGenerate::class,'fk_payment_transition_id');
    }




    // with customer table
    public function customer(){
        return $this->belongsTo(Customer::class, 'fk_customer_id');
    }




    // with customer table
    public function Area(){
        return $this->belongsTo(Area::class, 'fk_area_id');
    }




}
