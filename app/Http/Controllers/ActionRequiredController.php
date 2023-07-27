<?php

namespace App\Http\Controllers;

use App\Models\Well;
use App\Models\WellData;
use Illuminate\Http\Request;
use App\Models\ActionRequired;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActionRequiredController extends Controller
{
    public function index ()
    {
        // $actions = ActionRequired::orderBy('id', 'desc')->paginate(30);
        // $actions = DB::table('action_required')
        //                 ->join('wells', 'action_required.well_id', '=', 'wells.id')
                        // ->where('data_sent', false)
        //                 ->select('wells.well', 'action_required.*')
        //                 ->orderBy('id', 'desc')->paginate(30);
        $actions    = WellData::whereIn('status', ['action-required', 'action-not-required'])->orderBy('id', 'desc')->paginate(35);
        return view('sender.action-required', compact('actions'));
    }

     // Storing Data
    public function store (Request $request)
    {

        $action = ActionRequired::create(
            [
                'well_id'       => $request->well_id,
                'status'        => $request->status,
                'remarks'       => $request->remarks,
                'date'          => $request->date,
                'badge'         => $request->badge,
                'new_well'      => $request->new_well,
                'new_well_remarks'  => $request->new_well_remarks,

            ]
        );

        if ($action == null )
        {
            return back()->with('error', 'Something Wrong Happened');
        }

        Well::updateStatus('receiver_status', $request->well_id, 'completed'); // Setting well receiver_status to completed
        Well::updateStatus('sender_status', $request->well_id, 'completed'); // Setting well receiver_status to completed
        return back()->with('success', 'Data Shared Succcessfully');
    }

    // Action not required
    public function actionNotRequired (Request $request)
    {
        if (Well::where('id', $request->well_id) !== null)
        {
            if ($action = WellData::find($request->action_id))
            {
                $action->status = 'production-header';
                $action->vehicle = $request->vehicle;
                // $action->save();
                // $data = WellData::create(
                //     [
                //         'sender'    => Auth::user()->username,
                //         'well_id'   => $request->well_id,
                //         'vehicle'   => $request->vehicle,
                //         'badge'     => Auth::user()->badge,
                //         'date'      => date('Y-m-d'),
                //     ]
                // );
        
                if ($action->save())
                {
                    Well::updateStatus('receiver_status', $request->well_id, 'production-header'); // Setting well receiver_status to completed
                    Well::updateStatus('sender_status', $request->well_id, 'production-header'); // Setting well receiver_status to completed            
                    return back()->with('success', 'Data Shared Successfully');
                }
            }
        }

        return back()->with('error', 'Somthing went wrong');
    }
}
