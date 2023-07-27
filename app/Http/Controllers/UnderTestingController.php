<?php

namespace App\Http\Controllers;

use App\Models\Well;
use App\Models\UnderTesting;
use Illuminate\Http\Request;
use App\Models\ActionRequired;
use App\Models\WellData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnderTestingController extends Controller
{
    // Getting Wells Under Testing
    public function index ()
    {
        // $wells  = DB::table('under_testing')
        //                     ->join('wells', 'under_testing.well_id', '=', 'wells.id')
        //                     ->join('well_data', 'under_testing.well_id', '=', 'well_data.well_id')
        //                     ->select('under_testing.*', 'wells.*')
        //                     ->where('under_testing.testing_status', '=', null)
        //                     ->join('trunks', 'wells.trunk_id', '=', 'trunks.id')
        //                     ->where('trunks.area_id', Auth::user()->area_id)        
        //                     ->paginate(30);
        $trunks  = Auth::user()->area->trunks;
        return view('receiver.under-testing', compact('trunks'));
    }

    public function submit (Request $request)
    {
                $request->validate(
            [
                'oil_rate'          => 'required',
                'water_rate'        => 'required',
                'water_cut'         => 'required',
                'testing_status'    => 'required',
            ]
        );

        $wellData = WellData::find($request->wellData_id);
        $wellData->oil_rate             = $request->oil_rate;
        $wellData->water_rate           = $request->water_rate;
        $wellData->water_cut            = $request->water_cut;
        $wellData->undertesting_remarks = $request->undertesting_remarks;

        if ($wellData->suc_prss != null)
        {
            $wellData->status = 'production-header';
            Well::updateStatus('receiver_status', $request->well_id, 'production-header'); // Setting well receiver_status to zction-require

        } elseif ($request->testing_status == 'completed') {

            $wellData->status = 'action-required';
            Well::updateStatus('receiver_status', $request->well_id, 'action-required'); // Setting well receiver_status to zction-require

            
        } elseif ($request->testing_status == 'no-flow') {

            $wellData->status = 'production-header';
            Well::updateStatus('receiver_status', $request->well_id, 'action-required'); // Setting well receiver_status to zction-require

            
        }

        // $wellData->save();

        if ($wellData->save())
        {
            return back()->with('success', 'Data Shared Succcessfully');
        }
        return back()->with('error', 'Something Wrong Happened');
        
    }
    // Submitting Wells Under Testing
    public function old_submit (Request $request)
    {
        $request->validate(
            [
                'oil_rate'      => 'required',
                'water_rate'     => 'required',
                'water_cut'     => 'required',
                'testing_status'=> 'required',
                // 'remarks'       => 'required',
                // 'badge'         => 'required',
            ]
        );

        $under_testing  = UnderTesting::where('well_id', $request->well_id)->update(
            [
                'oil_rate'      => $request->oil_rate,
                'water_rate'    => $request->water_rate,
                'water_cut'     => $request->water_cut,
                'testing_status'=> $request->testing_status,
                'remarks'       => $request->remarks,
                'badge'         => Auth::user()->badge,
            ]
        );

        $action = ActionRequired::create(
            [
                'well_id'       => $request->well_id,
                'status'        => $request->testing_status,
                'remarks'       => $request->remarks,
                'date'          => date('Y-m-d'),
                'badge'         => Auth::user()->badge,

            ]
        );



        if ($action == null )
        {
            return back()->with('error', 'Something Wrong Happened');
        }
        
        Well::updateStatus('receiver_status', $request->well_id, 'under-testing'); // Setting well receiver_status to under-testing
        return back()->with('success', 'Data Shared Succcessfully');
    }
}
