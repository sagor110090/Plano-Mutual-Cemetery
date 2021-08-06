<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    
    protected $table = "owners";
    public $timestamps = false;
    protected $primaryKey = 'Owner#';
    public $incrementing = false;

    protected $fillable = [
        "Owner#",
        "LotIndex#",
        "Own_Salutation",
        "Own_Fname",
        "Own_Mname",
        "Own_Lname",
        "Own_Pname",
        "Own_Address",
        "Own_City" ,
        "Own_State",
        "Own_Zip" ,
        "Own_Phone",
        "Own_Notes",
    ];
}
