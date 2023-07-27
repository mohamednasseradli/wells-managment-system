<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Trunk;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiverController extends Controller
{
    public function index ()
    {

        return view('receiver.dashboard');
    }

    // Store new Receiver
    public function store (Request $request)
    {

        $request->validate(
            [
                'username'      => 'required|unique:users,username',
                'password'      => 'required|min:6',
                'role'          => 'required',
            ],
            [
                'username.required'     => 'Please Enter Username',
                'username.unique'       => 'Username Already Exists',
                'password.required'     => 'Please Enter Password',
                'password.min'          => 'Password must be 6 characters atleast',
                'role.required'         => 'Password choose user role',
            ]
        );

        // Storing Data

        Receiver::create(
            [
                'username'  => $request->username,
                'password'  => bcrypt($request->password),
                'password_decrypted'    => $request->password,
            ]
        );

        return back()->with('success', 'Username successfully added');
    }

    // Permitted Trunk Wells 
    public function myArea ()
    {
        if (Area::find(Auth::user()->area_id))
        {
            $area = Area::with('trunks.wells')->findOrFail(Auth::user()->area_id);

            // dd($area);
            return view('receiver.area', compact('area'));
        }

        return view('receiver.dashboard')->with('error', 'Somthing wrong happened');
    }

    // Trunk Wells
    public function receiverTrunkWells ($id)
    {
        if ($trunk = Trunk::find($id))
        {
            return view('receiver.trunk', compact('trunk'));

        }

        return back()->with('error', 'Somthing Went Wrong');
    }
}
