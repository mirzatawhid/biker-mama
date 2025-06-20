<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HazardReport extends Model
{
    //
    protected $fillable = [
    'user_id',
    'location',
    'description',
    'hazard_type',
];

}
