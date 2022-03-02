<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillGenerate extends Model
{
    use HasFactory;

    protected $table = "line_payment_transition_method";

    protected $guarded = [];


    // with customer table
    public function customer(){
        return $this->belongsTo(Customer::class, 'fk_customer_id');
    }



    public function customerv2(){
        return $this->belongsTo(Customer::class, 'id');
    }

    // to line_payment_multimonth_wise table
    public function lineTranMethod()
    {
        return $this->hasOne(BillPaymentMultiMonth::class,'fk_payment_transition_id')
                    ->where('fk_area_id',request('area'))
                    ->where('year',request('year'))
                    ->where('month', request('month'));
    }



    public function linePayTranMethods()
    {
        return $this->hasOne(BillPaymentMultiMonth::class,'fk_payment_transition_id');
    }



    // used in customer transaction
    public function TransactionTypes()
    {
        return $this->belongsTo(TransactionType::class,'id');
    }




    // BillGenerate - Staff Relation
    public function Staff(){
        return $this->belongsTo(Staff::class, 'id',);
    }



    // BillGenerate - Staff Relation
    public function Staff2(){
        return $this->belongsTo(Staff::class, 'fk_staff_id',);
    }




}

