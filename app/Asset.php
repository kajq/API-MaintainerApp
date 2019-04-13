<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'plaque', 'model', 'description', 'last_change', 'install_date', 'type_id', 'location_id', 'state'
    ];
}
