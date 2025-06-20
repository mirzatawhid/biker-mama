<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpRequest extends Model
{
    //
    protected $fillable = [
    'user_id',
    'location',
    'situation',
    'contact_number',
    'urgency_level',
];

}
