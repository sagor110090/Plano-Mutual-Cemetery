<?php

namespace App\Http\Controllers;

use App\Models\Grave;
use Illuminate\Http\Request;

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
            $graves = Grave::where('GraveID', 'LIKE', "%$keyword%")
                ->orWhere('Section', 'LIKE', "%$keyword%")
                ->orWhere('Lot#', 'LIKE', "%$keyword%")
                ->orWhere('Grave#', 'LIKE', "%$keyword%")
                ->orWhere('LotIndex#', 'LIKE', "%$keyword%")
                ->orWhere('LotText', 'LIKE', "%$keyword%")
                ->orWhere('Interred', 'LIKE', "%$keyword%")
                ->orWhere('Grave_Notes', 'LIKE', "%$keyword%")
                ->orWhere('Vet', 'LIKE', "%$keyword%")
                ->orWhere('Available', 'LIKE', "%$keyword%")
                ->orWhere('spacetype', 'LIKE', "%$keyword%")
                ->orderBy('GraveID')
                ->paginate($perPage);
        } else {
            $graves = Grave::orderBy('GraveID')->paginate($perPage);
        }

        return view('pages.graves.index', compact('graves'));
    }
    public function card(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 13;

        if (!empty($keyword)) {
            $graves = Grave::where('GraveID', 'LIKE', "%$keyword%")
                ->orWhere('Section', 'LIKE', "%$keyword%")
                ->orWhere('Lot#', 'LIKE', "%$keyword%")
                ->orWhere('Grave#', 'LIKE', "%$keyword%")
                ->orWhere('LotIndex#', 'LIKE', "%$keyword%")
                ->orWhere('LotText', 'LIKE', "%$keyword%")
                ->orWhere('Interred', 'LIKE', "%$keyword%")
                ->orWhere('Grave_Notes', 'LIKE', "%$keyword%")
                ->orWhere('Vet', 'LIKE', "%$keyword%")
                ->orWhere('Available', 'LIKE', "%$keyword%")
                ->orWhere('spacetype', 'LIKE', "%$keyword%")
                ->orderBy('GraveID')
                ->paginate($perPage);
        } else {
            $graves = Grave::orderBy('GraveID')->paginate($perPage);
        }

        return view('pages.graves.card-view', compact('graves'));
    }

    public function create()
    {
        return view('pages.graves.create');
    }

    public function store(Request $request)
    {
        Grave::create($request->all());
        return redirect()->back()->with('message', 'Successfully saved!');
    }

    public function map(Request $request)
    {

        return view('pages.graves.map');
    }
    public function edit($id,Request $request)
    {

        $grave = Grave::where('GraveID',$id)->first();
        return view('pages.graves.edit',compact('grave'));
    }

    public function update(Request $request,$id)
    {
        dd($request->all());
         Grave::where('GraveID',$id)->update([$request->all()]);
    }

}
