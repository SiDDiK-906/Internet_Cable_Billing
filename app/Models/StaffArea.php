<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffArea extends Model
{
    use HasFactory;

    protected $table = "staff_asign_area";
    protected $guarded = [];



    //-------------------------------------
    // StaffArea - Area Relation
    //-------------------------------------
    public function Area()
    {
        return $this->hasOne(Area::class, 'fk_area_id');
    }



    //-------------------------------------
    // StaffArea - Staff Relation
    //-------------------------------------
    public function Staff()
    {
        return $this->hasOne(Staff::class, 'fk_staff_id');
    }



    //-------------------------------------
    // StaffArea - Staff Relation2
    //-------------------------------------
    public function Staff2()
    {
        return $this->hasOne(Staff::class, 'id', 'fk_staff_id');
    }
}
