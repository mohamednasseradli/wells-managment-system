<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    
    public function trunks()
    {
        return $this->hasMany(Trunk::class);
    }

    // Defining Realtionship with users
    public function users ()
    {
        return $this->hasManyt(User::class);
    }
}
