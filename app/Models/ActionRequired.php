<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionRequired extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'action_required';

    protected $fillable = ['well_id', 'status', 'remarks', 'date' , 'badge', 'new_well', 'new_well_remarks'];

}
