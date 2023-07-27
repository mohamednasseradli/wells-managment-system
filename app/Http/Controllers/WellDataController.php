<?php

namespace App\Http\Controllers;

use App\Models\ActionRequired;
use App\Models\Well;
use App\Models\WellData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WellDataController extends Controller
{

    public function index ()
    {
        // $trunks  = Auth::user()->area->trunks;
        // $wells_data = $user = User::find($user_id); // Assuming you have the user ID

        $wells_data = WellData::join('wells', 'well_data.well_id', '=', 'wells.id')
                                ->join('trunks', 'wells.trunk_id', '=', 'trunks.id')
                                ->join('areas', 'trunks.area_id', '=', 'areas.id')
                                ->where('areas.id', Auth::user()->area_id)
                                ->select('well_data.*')
                                ->orderBy('id', 'desc')
                                ->paginate(40);
        
                    // dd($wells);
        return view('receiver.production-header', compact('wells_data'));
    }
    // Sending Well Data
    public function wellData (String $well = null, String $action_required_id = null)
    {
        $well_id = Well::where('well', $well)->first()->id?? null;
        $wellData_id = $action_required_id?? null;
        return view('sender.well-data', compact(['well', 'well_id', 'wellData_id']));
    }


    public function store (Request $request)
    {
        $request->validate(
            [
                'suc_prss'      => 'required',
                'dis_prss'      => 'required',
                'temp'          => 'required',
                'choke_set'     => 'required',
                'vehicle'       => 'required',
            ]
        );

        // Checking that well data exists
        if ($wellData = WellData::find($request->wellData_id))
        {

            $wellData->suc_prss     = $request->suc_prss;
            $wellData->dis_prss     = $request->dis_prss;
            $wellData->choke_set    = $request->choke_set;
            $wellData->temp         = $request->temp;
            $wellData->vehicle      = $request->vehicle;

            // Send To production header if it comes from undertesting 
            if ($wellData->water_rate !== null)
            {
                $wellData->status = 'production-header';
                Well::updateStatus('receiver_status', $request->well_id, 'production-header'); // Setting well receiver_status to production-header


            // Send To under testing if it comes from testing after on trunk 
            } elseif ($wellData->water_rate == null)
            {
                $wellData->status = 'testing';
                Well::updateStatus('receiver_status', $request->well_id, 'testing'); // Setting well receiver_status to testing

            }

            if ($wellData->save())
            {
                return back()->with('success', 'Data Shared Succcessfully');
            }

            return back()->with('error', 'Something Wrong Happened');
        }

        return back()->with('error', 'Invalid Data Provided');
    }
    // Storing Data
    public function old_store (Request $request)
    {

        if ($request->wellData_id !== null)
        {
            $action = WellData::find($request->wellData_id);
            $action->data_sent = true;
            $action->save();
        }
        
        $wellData = WellData::create(
            [
                'sender'    => Auth::user()->username,
                'well_id'   => $request->well_id,
                'suc_prss'  => $request->suc_prss,
                'temp'      => $request->temp,
                'dis_prss'  => $request->dis_prss,
                'choke_set' => $request->choke_set,
                'vehicle'   => $request->vehicle,
                'date'      => date('Y-m-d'),
            ]
        );

        if ($wellData == null )
        {
            return back()->with('error', 'Something Wrong Happened');
        }
        
        Well::updateStatus('receiver_status', $request->well_id, 'completed'); // Setting well receiver_status to completed
        // Well::updateStatus('sender_status', $request->well_id, 'completed'); // Setting well receiver_status to completed
        return back()->with('success', 'Data Shared Succcessfully');
    }

    // Not Required
    public function notRequired (Request $request, $well, $action_required_id)
    {
        if (Well::where('well', $well) !== null)
        {
            if ($action_required = ActionRequired::find($action_required_id))
            {
                $data = WellData::create(
                    [
                        'sender'    => Auth::user()->username,
                        'well_id'   => $request->well_id,
                        'date'      => date('Y-m-d'),
                    ]
                );
        
                if ($data == null )
                {
                    return back()->with('error', 'Something Wrong Happened');
                }
            }
        }

        return back()->with('error', 'Somthing went wrong');
    }
}
