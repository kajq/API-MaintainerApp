<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'date', 'observations', 'technician_id', 'client', 'location_id', 'company_id', 'type'
    ];
}
