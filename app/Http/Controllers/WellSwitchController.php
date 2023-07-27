<?php

namespace App\Http\Controllers;

use App\Models\SwitchNotification;
use App\Models\Well;
use App\Models\WellData;
use App\Models\WellSwitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WellSwitchController extends Controller
{

    public function index ()
    {

        return view('sender.well-switch');

    }

    // Well switch Single
    public function sendWellSwitch($well_id)
    {
        if ($well_id == null)
        {
            return redirect()->route('sender-dashboard');
        }

        $well           = Well::find($well_id);
        $acceptTesting  = Well::acceptTesting($well_id);

        // dd($well);
        return view('sender.well-switch-single', compact(['well', 'acceptTesting']));
    }

    
    // Edit Well Switch Data
    public function edit ($id)
    {
        if ($data = WellSwitch::where('well_id', $id)->first())
        {
            return view('sender.update-well-switch', compact('data'));
        }
    }

    // Update Well Switch Data
    public function update (Request $request, $id)
    {
        if ($data = WellSwitch::find($id))
        {
            $data->status       = $request->status;
            $data->remarks      = $request->remarks;
            $data->badge        = $request->badge;
            $data->date         = $request->date;
            $data->save();
            Well::where('well', $data->well)->update(['status'   => $request->status]); // Setting well status
            return back()->with('success', 'Data Updated Successfully');
        }
    }

    // Storing Data
    public function store (Request $request)
    {

        if (!$well = Well::find($request->well_id))
        {
            return back()->with('error', 'Something Wrong Happened');
            
        }

        // Checking that well is not under-testing
        if ($well->receiver_status == 'under-testing')
        {
            return back()->with('error', 'Failed, Well is now Under Testing.');
        }
        
        // Checking if receiver status is testing
        if ($request->status == 'testing')
        {
            $wellData   = WellData::create(
                [
                    'sender_badge'  => $request->badge,
                    'switch_date'   => $request->date,
                    'vehicle'       => $request->vehicle,
                    'well_id'       => $request->well_id,
                    'status'        => $request->status,
                ]
            );
    
            if ($wellData == null )
            {
                return back()->with('error', 'Something Wrong Happened');
            }
        }
        // Sending Notification
        SwitchNotification::create(
            [
                'well'      => $well->well,
                'status'    => $request->status,
                'area_id'       => $well->trunk->area->id,

            ]

        );
        
        // dd($request->status);
        Well::updateStatus('sender_status', $request->well_id, $request->status);
        
        // Check if old status is on trunk
        if ($well->sender_status == 'trunk' && $request->status == 'testing')
        {

            // $well_id    = $well->id;

            return redirect('/sender/well-data/'. $wellData->well->well . '/' . $wellData->id)->with('success', 'Data Shared, Now send Well Data as well was on trunk');
            
            // return view('sender.well-data', compact(['well_id']));
            
        }

        return redirect('/sender/well-data/'. $wellData->well->well . '/' . $wellData->id)->with('success', 'Data Shared, Now You Can send Well Data');

        // return back()->with('success', 'Data Shared Succcessfully');
    }

}
