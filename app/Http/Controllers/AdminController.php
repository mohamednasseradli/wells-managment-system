<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\Well;
use App\Models\Trunk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index ()
    {
        $trunks = Trunk::all()->count();
        $wells = Well::all()->count();
        $areas = Area::all();
        $latestTrunks = Trunk::latest('id')->take(5)->get();
        return view('admin.dashboard', compact(['trunks', 'wells', 'areas', 'latestTrunks']));
    }

    // Receivers
    public function users ()
    {

        $users = User::ORDERBY('id', 'desc')->paginate(30);
        $areas = Area::all();
        return view('admin.users', compact(['users', 'areas']));
    }


}
