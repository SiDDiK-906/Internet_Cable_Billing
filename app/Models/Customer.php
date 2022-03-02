<?php

namespace App\Models;

use App\Models\Area;
use App\Models\LineCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customer";
    protected $guarded = [];




    public function area()
    {
        return $this->belongsTo(Area::class, 'id');
    }


    // used in customer transaction
    public function areas()
    {
        return $this->belongsTo(Area::class, 'fk_area_id');
    }




    public function lineCategories()
    {
        return $this->belongsTo(LineCategory::class,'fk_line_id');
    }





    public function linePayTranMethod()
    {
        return $this->hasMany(BillGenerate::class, 'id');
    }


    // used in month wise payment index.blade.php
    public function bill_generates()
    {
        return $this->hasMany(BillGenerate::class, 'fk_customer_id');
    }



    // n
    public function billPayments(){
        return $this->hasMany(BillPaymentMultiMonth::class, 'id');
    }




    // n
    public function billgenerates(){
        return $this->hasMany(BillGenerate::class, 'id');
    }



}
