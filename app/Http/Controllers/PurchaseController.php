<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $purchases = Purchase::where('Owner#' , 'LIKE' , "%$keyword%")
                        ->orWhere('PurchaseID' , 'LIKE' , "%$keyword%")
                             ->orWhere('GraveID' , 'LIKE' , "%$keyword%")
                             ->orWhere('Purchase_Date' , 'LIKE' , "%$keyword%")
                             ->orWhere('Purchase_Amt' , 'LIKE' , "%$keyword%")
                             ->orWhere('Reference#' , 'LIKE' , "%$keyword%")
                             ->orWhere('Purchase_Notes' , 'LIKE' , "%$keyword%") 

                        ->paginate($perPage);
        } else {
            $purchases = Purchase::paginate($perPage);
        }

        return view('pages.purchases.index', compact('purchases'));
    }
}
