<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineCategory extends Model
{
    use HasFactory;

    protected $table = "line_category";
    protected $guarded = [];

    // join  line_category & customer table
    public function customer(){
        return $this->hasMany(Customer::class);
    }
}
