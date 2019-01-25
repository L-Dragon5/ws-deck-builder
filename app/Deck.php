<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    protected $table = 'ws_decks';

    protected $fillable = [
        'series_id',
        'name',
        'description',
        'win_location',
        'win_date',
        'win_participants',
        'win_result',
        'win_ranking',
        'deck',
        'hash'
    ];

    public $series_name = null;
}
