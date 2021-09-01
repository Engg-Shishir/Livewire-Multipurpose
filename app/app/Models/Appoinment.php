<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
    	'date' => 'datetime',
    	'time' => 'datetime',
     /*    'members' => 'array', */
    ];
}
