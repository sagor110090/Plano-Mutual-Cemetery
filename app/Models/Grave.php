<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grave extends Model
{
    protected $table = "Graves";

    public $timestamps = false;
    protected $primaryKey = 'GraveID';
    public $incrementing = false;

    protected $fillable = [
        'GraveID',
        'Section',
        'Lot#',
        'Grave#',
        'LotIndex#',
        'LotText',
        'Interred',
        'Deceased_Salutation',
        'Deceased_Fname',
        'Deceased_Lname',
        'Deceased_Pname',
        'Deceased_BirthDate',
        'Deceased_DeathDate',
        'Deceased_BurialDate',
        'Grave_Notes',
        'Vet',
        'Available',
        'spacetype',
    ];

}
