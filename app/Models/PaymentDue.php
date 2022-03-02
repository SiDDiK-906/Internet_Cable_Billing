<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDue extends Model
{
    use HasFactory;

    protected $table = "line_payment_due_paid";

    protected $guarded = [];


    //  to line_payment_transition_method table
    public function BillPaymentMultiMonth()
    {
        return $this->belongsTo(BillPaymentMultiMonth::class,'id');
    }


}
