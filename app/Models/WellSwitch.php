<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellSwitch extends Model
{
    use HasFactory;

    protected $table = 'well_switch';
    
    public $timestamps = false;

    protected $fillable = ['sender', 'well_id', 'vehicle', 'remarks', 'badge', 'date', 'trunk_id', 'seen'];
}
