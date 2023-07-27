<?php

namespace App\Http\Controllers;

use App\Models\Well;
use App\Models\UnderTesting;
use Illuminate\Http\Request;
use App\Models\ActionRequired;
use App\Models\SwitchNotification;
use App\Models\WellData;
use App\Models\WellSwitch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class NotificationController extends Controller
{
    // Notifications 
    public function index ()
    {
        $trunks  = Auth::user()->area->trunks;
        // $notifications  = WellSwitch::OrderBy('date', 'desc')->paginate(30);
        // $notifications  = DB::table('well_switch')
        //                         ->join('wells', 'well_switch.well_id', '=', 'wells.id')
        //                         ->join('trunks', 'wells.trunk_id', '=', 'trunks.id')
        //                         ->whereNotIn('well_switch.well_id', function($query) {
        //                             $query->select('well_id')->from('under_testing');
        //                         })
        //                         ->where('trunks.area_id', '=', Auth::user()->area_id)
        //                         // ->where('well_switch.seen', false)
        //                         ->where('wells.sender_status', 'testing',)
        //                         // ->where('wells.sender_status', '!=', 'other')
        //                         ->select('wells.*', 'well_switch.date', 'well_switch.id as well_switch_id')
        //                         ->OrderBy('date', 'desc')->paginate(30);
// dd((Auth::user()));
        // $side_notifications  = DB::table('well_switch')
        //                         ->join('wells', 'well_switch.well_id', '=', 'wells.id')
        //                         ->join('trunks', 'wells.trunk_id', '=', 'trunks.id')
        //                         ->where('trunks.area_id', '=', Auth::user()->area_id)
        //                         // ->where('well_switch.seen', 0)
        //                         ->where('wells.sender_status', '!=', 'testing')
        //                         // ->orWhere('wells.sender_status', '=', 'other')
        //                         ->select('wells.*', 'well_switch.date', 'well_switch.id as well_switch_id', 'well_switch.remarks', 'well_switch.seen')
        //                         ->OrderBy('date', 'desc')->paginate(30);
        // $side_notifications     = SwitchNotification::where('area_id', Auth::user()->area->id)->orderBy('id', 'desc')->take(10)->get();
        // dd($side_notifications);
        $wells          = Well::all();


        // dd($side_notifications);
        return view('receiver.notifications', compact(['trunks' ,'wells']));
    }

    // Submitting Receiver Notification
    public function submit (Request $request)
    {
        $request->validate(
            [
                'remarks'   => 'required_if:status,production'
            ]
        );
        

        if (! $wellData = WellData::find($request->wellDataId))
        {
            return back()->with('error', 'Something Wrong Happened');
        }


        if ($request->status == 'testing' || $request->has('testing-ready'))
        {
            $wellData->status = 'under-testing';
            $wellData->undertesting_datetime = date('Y-m-d H:i:s');
            $wellData->receiver_badge = $request->badge;
            $wellData->save();

            if (! $wellData->save())
            {
                return back()->with('error', 'Something Wrong Happened');
            }
        
            Well::updateStatus('receiver_status', $wellData->well_id, 'under-testing'); // Setting well receiver_status to under-testing
            // Well::updateStatus('sender_status', $wellData->well_id, 'under-testing'); // Setting well receiver_status to under-testing

            return back()->with('success', 'Well is now under testing');

        } elseif ($request->status == 'production')
        {

            if ($request->has('cancel')) {

                $wellData->status = 'action-not-required';

                if (! $wellData->save())
                {
                    
                    return back()->with('error', 'Something Wrong Happened');

                }
            
                Well::updateStatus('receiver_status', $wellData->well_id, 'action-required');
                
                return back()->with('success', 'Action required sent successfully');
                
            } elseif ($request->has('submit')) {
                
                $wellData->status = 'testing-ready';

                Well::updateStatus('receiver_status', $wellData->well_id, 'testing-ready'); // Setting well receiver_status to under-testing

                if (! $wellData->save())
                {
                    
                    return back()->with('error', 'Something Wrong Happened');

                }
                return back()->with('success', 'Well is now ready for testing');
            }
        }

        return back()->with('error', 'Somthing went wrong');

    }

    // Mark Notification As Seen
    public function markAsSeen ($id)
    {
        if ($notification = SwitchNotification::find($id))
        {
            $notification->seen = 1;
            $notification->save();

            return back()->with('success', 'Notification Marked As Acknowledged Successfully');
        }
        
        return back()->with('error', 'Something wrong Happened');
    }

    
}
