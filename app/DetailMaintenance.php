<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailMaintenance extends Model
{
    protected $fillable = [
        'maintenance_id', 'asset_id', 'detail', 'type'
    ];
}
