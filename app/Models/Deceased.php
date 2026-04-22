<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deceased extends Model
{
    protected $fillable = [
        'name',
        'birth_date',
        'death_date',
        'age_at_death',
        'gender',
        'block',
        'grave_number',
        'google_maps_link',
        'photo'
    ];
}
