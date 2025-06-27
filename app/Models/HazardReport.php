<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HazardReport extends Model
{
    //
    protected $fillable = [
    'user_id', 'hazard_type', 'description', 'latitude', 'longitude', 'address'
];


}
