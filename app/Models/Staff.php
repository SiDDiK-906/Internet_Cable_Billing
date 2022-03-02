<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = "staff";
    protected $guarded = [];




    //-------------------------------------
    // Staff - Area Relation
    //-------------------------------------
    public function Area()
    {
        return $this->belongsTo(Area::class,'id');
    }


    //-------------------------------------
    // Staff - Area Relation
    //-------------------------------------
    public function Areas()
    {
        return $this->belongsTo(Area::class,'fk_area_id');
    }



    //-------------------------------------
    // Staff - BillGenerate Relation
    //-------------------------------------
    public function BillGenerate()
    {
        return $this->hasMany(BillGenerate::class, 'fk_staff_id');
    }


    //-------------------------------------
    // Staff - BillGenerate Relation
    //-------------------------------------
    public function BillGenerateReport()
    {
        return $this->hasMany(BillGenerate::class, 'fk_staff_id')->where('paid_amount','!=',0);
    }
}
