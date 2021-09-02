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

    // Access Client data
    public function client()
    {
    	return $this->belongsTo(Client::class);
    }

    // Show Appoinment badge Dynamacally
    public function getStatusBadgeAttribute()
    {
    	$badges = [
    		'SCHEDULED' => 'primary',
    		'CLOSED' => 'success',
    	];

    	return $badges[$this->status];
    }
}
