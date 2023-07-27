<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Well;
use App\Models\Trunk;
use Illuminate\Http\Request;

class TrunkController extends Controller
{
    public function index ()
    {
        $trunks = Trunk::paginate(30);
        $areas  = Area::all();
        $wells  = Well::all();

        return view('admin.trunks', compact(['trunks', 'areas', 'wells']));
    }

    public function show (String $id)
    {
        if ($trunk = Trunk::find($id))
        {

            $trunks = Trunk::paginate(30);
            $areas  = Area::all();
            $wells  = Well::all();
    
        return view('admin.trunk', compact(['trunk', 'areas', 'wells']));
        }
        return back()->with('error', 'Something wrong Happened');

    }
    public function store (Request $request)
    {
        $request->validate(
            [
                'name'      => 'required',
                'area_id'   => 'required',
            ]
        );

        // Check there is no similar trunks on same trunk
        if (Trunk::where(['name' => $request->name, 'area_id' => $request->area_id])->first())
        {
            return back()->with('error', 'This trunk already exists on this area.');
        }

        // Create Trunk
        $trunk  = Trunk::create(
            [
                'name'      => $request->name,
                'area_id'   => $request->area_id,
            ]
        );

        if ($trunk)
        {
            return back()->with('success', 'Trunk Added Successfully');
        }
        
        return back()->with('error', 'Something wrong Happened');
    }

    // Delete Trunk
    public function destroy (Request $request)
    {
        if ($trunk = Trunk::find($request->trunk_id))
        {
            $trunk->delete();
            return back()->with('success', 'Trunk Deleted Successfully');
        }
        
        return back()->with('error', 'Something wrong Happened');
    }
}
