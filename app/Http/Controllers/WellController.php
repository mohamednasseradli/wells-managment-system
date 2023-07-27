<?php

namespace App\Http\Controllers;

use App\Models\Well;
use Illuminate\Http\Request;

class WellController extends Controller
{
    public function store (Request $request)
    {
        $request->validate(
            [
                'well'          => 'required',
                'trunk'         => 'required',
            ]
        );

        
        // Check there is no similar wells on same trunk
        if (Well::where(['well' => $request->well, 'trunk_id' => $request->trunk])->first())
        {
            return back()->with('error', 'This well already exists on this trunk.');
        }


        $well  = Well::create(
            [
                'well'          => $request->well,
                'trunk_id'      => $request->trunk,
            ]
        );

        if ($well)
        {
            return back()->with('success', 'Well Added Successfully');
        }
        
        return back()->with('success', 'Something wrong Happened');
    }

    // Delete Well
    public function delete (Request $request)
    {
        if ($well = Well::find($request->well_id))
        {
            $well->delete();
            return back()->with('success', 'Well Deleted Successfully');
        }
        
        return back()->with('error', 'Something wrong Happened');
    }
}
