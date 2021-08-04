<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = "Purchases";
    public $timestamps = false;
    protected $primaryKey = 'PurchaseID';
    public $incrementing = false;

    protected $fillable=[
        "PurchaseID",
        "Owner#",
         "GraveID",
         "Purchase_Date",
         "Purchase_Amt",
        "Reference#",
         "Purchase_Notes",
    ]; 
}
