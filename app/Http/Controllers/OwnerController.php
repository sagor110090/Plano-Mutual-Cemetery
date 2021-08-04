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
            $owners = Owner::orderBy('Owner#')->paginate($perPage);
        }

        return view('pages.owners.index', compact('owners'));
    }
    public function card(Request $request)
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
            $owners = Owner::orderBy('Owner#')->paginate($perPage);
        }

        return view('pages.owners.card-view', compact('owners'));
    }
    public function create()
    {
        return view('pages.owners.create');
    }
    public function store(Request $request)
    {
        Owner::create($request->all());
        return back()->with('message','Successfully saved..');
    }
    public function edit($id)
    {
        $owner = Owner::where('Owner#',$id)->first();
        return view('pages.owners.edit',compact('owner'));
    }
    public function update($id,Request $request)
    {
        Owner::where('Owner#',$id)->first()->update($request->all());
        return back()->with('message','Successfully updated..');
    }
    public function delete($id)
    {
        // dd(Owner::where('Owner#',$id)->first());
        Owner::where('Owner#',$id)->first()->delete();
        return back()->with('message','Successfully deleted..');

    }
}
