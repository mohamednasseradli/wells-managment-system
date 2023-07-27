<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Trunk;
use App\Models\Well;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    //
    public function index ()
    {
        $areas  = Area::paginate(30);

        return view('admin.areas', compact('areas'));
    }

    // 
    public function store (Request $request)
    {
        $request->validate(
            [
                'name'  => 'required',
            ],
            [
                'name.required'     => 'The of the area is required',
            ]
        );

        $area   = Area::create(
            [
                'name'      => $request->name
            ]
        );

        if ($area)
        {
            return back()->with('success', 'Area added Successfully');
        }

        return back()->with('error', 'Something wrong happened');

    }

    // 
    public function show (String $id)
    {
        if (Area::find($id))
        {
            $area = Area::with('trunks.wells')->findOrFail($id);
            $trunks = Trunk::where('area_id', $id)->orderBy('id', 'desc')->paginate(30);
            return view('admin.area', compact(['area', 'trunks']));
        }

        return view('admin.areas')->with('error', 'Somthing wrong happened');
    }

    // 
    public function destroy (Request $request)
    {
        if ($area = Area::find($request->area_id))
        {
            $area->delete();

            return back()->with('success', 'Area Was Deleted Successfully');
        }

        return back()->with('error', 'Somthing wrong happened');
    }
}
