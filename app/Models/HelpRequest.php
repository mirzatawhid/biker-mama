<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpRequest extends Model
{
    //
    protected $fillable = [
        'user_id',
        'help_type',
        'description',
        'latitude',
        'longitude',
        'address'
];

}
