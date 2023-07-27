<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnderTesting extends Model
{
    use HasFactory;
    
    protected $table = 'under_testing';
    
    public $timestamps = false;

    protected $fillable = ['date', 'time', 'oil_rate', 'water_rate', 'water_cut', 'badge', 'testing_status', 'remarks','well_id'];
}
