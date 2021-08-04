<?php

namespace App\Http\Controllers;

use App\Models\Grave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function edit($id, Request $request)
    {

        $grave = Grave::where('GraveID', $id)->first();
        return view('pages.graves.edit', compact('grave'));
    }

    public function update(Request $request, $id)
    {
        $data = Grave::where('GraveID', $id)->first();
        $data->update($request->except('_token'));
        return back()->with('message', 'Successfully saved..');
    }

    public function delete($id)
    {
        Grave::where('GraveID', $id)->first()->delete();
        return back()->with('message', 'Successfully deleted..');
    }
    public function core()
    {
        $grave = 'SELECT *, ST_AsGeoJSON(geom, 9) AS geojson FROM public."pmc"
        p LEFT	JOIN public."Graves" g ON g."GraveID" = p."all_spacei"';
        $result = DB::select(DB::raw($grave));

        $features=[];
       foreach ($result as $row ) {
          $grave = (array) $row;
           unset($grave['geom']);
           $geometry = $grave['geojson']= json_decode($grave['geojson']);
           unset($grave['geojson']);
           $feature=["type"=>"Feature","geometry"=>$geometry, "properties"=>$grave];
          // getting a valid feature geojson
       // echo json_encode($feature). "<br><br>";

        array_push($features,$feature);
       }

       $featureCollection=["type"=>"FeatureCollection", "features"=>$features];
       echo json_encode($featureCollection);
    }

    public function sections()
    {
        $section ='SELECT *, ST_AsGeoJSON(geom, 9) AS geojson FROM public."sections"';
        $result = DB::select(DB::raw($section));

        $features=[];
       foreach ($result as $row ) {
          $section = (array) $row;
           unset($section['geom']);
           $geometry = $section['geojson']= json_decode($section['geojson']);
           unset($section['geojson']);
           $feature=["type"=>"Feature","geometry"=>$geometry, "properties"=>$section];
          // getting a valid feature geojson
       // echo json_encode($feature). "<br><br>";

        array_push($features,$feature);
       }

       $featureCollection=["type"=>"FeatureCollection", "features"=>$features];
       return json_encode($featureCollection);
    }
}
