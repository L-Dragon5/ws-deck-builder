<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'ws_cards';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'name_eng',
        'rarity',
        'set_name',
        'side',
        'set_code',
        'type',
        'color',
        'level',
        'cost',
        'power',
        'soul',
        'trigger_icon',
        'trait_one',
        'trait_one_eng',
        'trait_two',
        'trait_two_eng',
        'text',
        'flavor'
    ];
}
