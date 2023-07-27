<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellData extends Model
{
    use HasFactory;

    protected $table = 'well_data';

    public $timestamps = false;

    protected $guarded = [];

    // Relationship to Wells

    public function well ()
    {
        return $this->belongsTo(Well::class);
    }
}
