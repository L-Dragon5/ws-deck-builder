<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $table = 'ws_series';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'name_eng',
        'set_codes'
    ];
}
