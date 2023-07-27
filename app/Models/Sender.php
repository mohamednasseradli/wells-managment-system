<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sender extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = ['username', 'password', 'password_decrypted'];
}
