<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $owners = Owner::where('Owner#' , 'LIKE' , "%$keyword%")
                        ->orWhere('LotIndex#' , 'LIKE' , "%$keyword%") 
                             ->orWhere('Own_Salutation' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_Fname' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_Mname' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_Lname' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_Pname' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_Address' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_City' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_State' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_Zip' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_Phone' , 'LIKE' , "%$keyword%")
                             ->orWhere('Own_Notes' , 'LIKE' , "%$keyword%")
                        ->paginate($perPage);
        } else {
            $owners = Owner::paginate($perPage);
        }

        return view('pages.owners.index', compact('owners'));
    }
}
