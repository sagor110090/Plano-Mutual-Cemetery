<?php

namespace App\Http\Controllers;

use App\Models\Grave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function gravesBySection()
    {
        $datas = Grave::whereNotNull('Section')->where('Section','LIKE',request()->get('search'))
                        ->join('Purchases','Purchases.GraveID','=','Graves.GraveID')
                        ->join('owners','owners.Owner#','=','Purchases.Owner#')
                        ->orderBy('Section')
                        ->get()
                        ->groupBy('Section');

                        // dd($datas);

        return view('report.list-owner-by-section',['datas'=>$datas]);
    }
}
