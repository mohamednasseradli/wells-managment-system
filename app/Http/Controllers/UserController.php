<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index ()
    {
        $users  = User::paginate(30);
        $areas  = Area::all();
        return view('admin.users', compact(['users', 'areas']));
    }

    // Store new Receiver
    public function store (Request $request)
    {

        $request->validate(
            [
                'username'      => 'required|unique:users,username',
                'password'      => 'required|min:6',
                'role'          => 'required',
                // 'badge'         => 'required',
                'area'          => 'required_if:role,receiver',
            ],
            [
                'username.required'     => 'Please Enter Username',
                'username.unique'       => 'Username Already Exists',
                'password.required'     => 'Please Enter Password',
                'password.min'          => 'Password must be 6 characters atleast',
                'role.required'         => 'Please choose user role',
                // 'badge.required'        => 'Please enter user badge',
                'area.required'         => 'Area is required when the role is receiver',
            ]
        );

        
        // Storing Data
        User::create(
            [
                'username'          => $request->username,
                'password'          => bcrypt($request->password),
                'password_decrypted'=> $request->password,
                'role'              => $request->role,
                'area_id'           => $request->area ?? Area::first()->id,
            ]
        );

        return back()->with('success', 'Username successfully added');
    }

    // Delete User
    public function destroy (Request $request)
    {
        if ($user = User::find($request->user_id))
        {
            $user->delete();
            
            return back()->with('success', 'User Deleted Successfully');
        }

        return back()->with('error', 'Something wrong happened');
    }
}
