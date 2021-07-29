<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grave;

class GraveController extends Controller
{
    // function index()
    // {
    //     $grave = Grave::paginate(10);
    //     return view('pages.graves.index',['graves'=>$grave]);
    // }
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $graves = Grave::where('GraveID' , 'LIKE' , "%$keyword%")
                        ->orWhere('Section' , 'LIKE' , "%$keyword%")
                        ->orWhere('Lot#' , 'LIKE' , "%$keyword%")
                        ->orWhere('Grave#' , 'LIKE' , "%$keyword%")
                        ->orWhere('LotIndex#' , 'LIKE' , "%$keyword%")
                        ->orWhere('LotText' , 'LIKE' , "%$keyword%")
                        ->orWhere('Interred' , 'LIKE' , "%$keyword%")
                        // ->orWhere('Deceased_Salutation' , 'LIKE' , "%$keyword%")
                        // ->orWhere('Deceased_Fname' , 'LIKE' , "%$keyword%")
                        // ->orWhere('Deceased_Lname' , 'LIKE' , "%$keyword%")
                        // ->orWhere('Deceased_Pname' , 'LIKE' , "%$keyword%")
                        // ->orWhere('Deceased_BirtdDate' , 'LIKE' , "%$keyword%")
                        // ->orWhere('Deceased_DeatdDate' , 'LIKE' , "%$keyword%")
                        // ->orWhere('Deceased_BurialDate' , 'LIKE' , "%$keyword%")
                        ->orWhere('Grave_Notes' , 'LIKE' , "%$keyword%")
                        ->orWhere('Vet' , 'LIKE' , "%$keyword%")
                        ->orWhere('Available' , 'LIKE' , "%$keyword%")
                        ->orWhere('spacetype' , 'LIKE' , "%$keyword%")
                        ->paginate($perPage);
        } else {
            $graves = Grave::paginate($perPage);
        }

        return view('pages.graves.index', compact('graves'));
    }
}
