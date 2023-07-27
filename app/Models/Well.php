<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Well extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    
    // Relationship to Well Data
    public function data ()
    {
        return $this->hasMany(WellData::class);
    }


    public function trunk()
    {
        return $this->belongsTo(Trunk::class);
    }

    // 
    public static function updateStatus ($type, $id, $status)
    {
        $well   = DB::table('wells')->where('id', $id)->update(
            [
                $type   => $status,
            ]
        );

        if ($well)
        {
            return true;
        }

        return false;
    }
    

    // function to check that no wells on same well's trunk is on testing or undertesting
    public static function acceptTesting ($well_id)
    {
        $trunk_id = Well::find($well_id)->trunk_id ?? null;

        if ($trunk_id !== null)
        {
            $wells  = Well::where('trunk_id', $trunk_id)
                            // ->where('sender_status', '=', 'testing')
                            ->where('receiver_status' ,'=', 'under-testing')
                            ->orWhere('receiver_status' ,'=', 'testing-ready')
                            ->count();
                            // dd($wells);
            if ($wells > 0)
            {
                return false;
            }
        }

        return true;
    }
}
