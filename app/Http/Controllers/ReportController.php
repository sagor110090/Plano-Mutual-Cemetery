<?php

namespace App\Http\Controllers;

use App\Models\Grave;
use App\Models\Owner;
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

        return view('report.list-owner-by-section',['datas'=>$datas]);
    }
    public function gravesBypurchase()
    {
        $datas = Grave::whereNotNull('Purchase_Date')
                        ->join('Purchases','Purchases.GraveID','=','Graves.GraveID')
                        ->join('owners','owners.Owner#','=','Purchases.Owner#')
                        ->orderBy('Purchase_Date')
                        ->get()
                        ->groupBy('Purchase_Date');

        return view('report.list-owner-by-purchase-date',['datas'=>$datas]);
    }

    public function gravesByName()
    {
        $datas = Grave::whereNotNull('Own_Fname')
                        ->join('Purchases','Purchases.GraveID','=','Graves.GraveID')
                        ->join('owners','owners.Owner#','=','Purchases.Owner#')
                        ->orderBy('Own_Fname')
                        ->get()
                        ->groupBy('Own_Fname');
        return view('report.list-owner-by-name',['datas'=>$datas]);

    }

    public function burials_by_deceased()
    { 
        $datas = Grave::where("Interred",true)->join('Purchases','Purchases.GraveID','=','Graves.GraveID')
        ->join('owners','owners.Owner#','=','Purchases.Owner#')->get();

        return view('report.burials_by_deceased',['datas'=>$datas]);

    }
}
