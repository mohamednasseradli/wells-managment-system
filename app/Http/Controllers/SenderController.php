<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Well;
use App\Models\Sender;
use App\Models\Trunk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SenderController extends Controller
{
    public function index ()
    {

        $areas  = Area::orderBy('id', 'desc')->paginate(16);
        return view('sender.dashboard', compact('areas'));
    }

    // 
    public function area ($id)
    {
        if (Area::find($id))
        {
            // $trunk   = Trunk::where('area_id', $area->id);
            // $wells   = Well::where('trunk_id', $trunk->id);
            $area = Area::with('trunks.wells')->findOrFail($id);

            return view('sender.area', compact('area'));
        }

        return view('sender.dashboard')->with('error', 'Somthing wrong happened');
    }
    
    // Store new Sender
    public function store (Request $request)
    {

        $request->validate(
            [
                'username'      => 'required|unique:receivers,username',
                'password'      => 'required|min:6'
            ],
            [
                'username.required'     => 'Please Enter Username',
                'username.unique'       => 'Username Already Exists',
                'password.required'     => 'Please Enter Password',
                'password.min'          => 'Password must be 6 characters atleast',
            ]
        );

        // Storing Data

        Sender::create(
            [
                'username'  => $request->username,
                'password'  => bcrypt($request->password),
                'password_decrypted'    => $request->password,
            ]
        );

        return back()->with('success', 'Username successfully added');
    }

    // Trunk Wells
    public function trunkWells ($id)
    {
        if ($trunk = Trunk::find($id))
        {
            return view('sender.trunk', compact('trunk'));

        }

        return back()->with('error', 'Somthing Went Wrong');
    }
}
