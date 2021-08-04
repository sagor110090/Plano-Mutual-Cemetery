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
            $purchases = Purchase::orderBy('PurchaseID')->paginate($perPage);
        }

        return view('pages.purchases.index', compact('purchases'));
    }
    public function card(Request $request)
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
            $purchases = Purchase::orderBy('PurchaseID','DESC')->paginate($perPage);
        }

        return view('pages.purchases.card-view', compact('purchases'));
    }

    public function create()
    {
        return view('pages.purchases.create');
    }
    public function store(Request $request)
    {
        Purchase::create($request->all());
        return back()->with('message','Successfully saved..');
    }
    public function edit($id)
    {
        $purchase = Purchase::where('PurchaseID',$id)->first();
        return view('pages.purchases.edit',compact('purchase'));
    }
    public function update(Request $request,$id)
    {
        $purchase = Purchase::where('PurchaseID',$id)->first()->update($request->all());
        return back()->with('message','Successfully updated..');
    }
    public function delete($id)
    {
        $purchase = Purchase::where('PurchaseID',$id)->first()->delete();
        return back()->with('message','Successfully deleted..');
    }
}
