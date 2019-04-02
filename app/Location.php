<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    protected $fillable = [
        'name', 'description', 'company_id'
    ];
}
