<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    protected $table = "line_transition_type";
    protected $guarded = [];


    public function BillPaymentMultiMonth()
    {
        return $this->hasMany(BillPaymentMultiMonth::class, 'id');
    }




    public function BillGenerates()
    {
        return $this->hasMany(BillGenerate::class, 'fk_transition_type_id');
    }


}
