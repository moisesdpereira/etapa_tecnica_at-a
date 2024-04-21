<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts =  [
        'when'  => 'datetime',
        'details' => 'json',
    ];
}
