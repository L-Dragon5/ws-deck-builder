<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Card;
use App\Series;

class CardController extends Controller
{
    public function index(Request $request) {
        $pagination_num = 30;
        $series = Series::orderBy('name_eng', 'asc')->get();
        $cards = new Card;
        $series_id = null;

        if($request->has('series')) {
            $series_id = filter_var($request->query('series'), FILTER_SANITIZE_NUMBER_INT);;
            $set_codes = json_decode(Series::where('id', $series_id)->pluck('set_codes')[0]);
            $cards = $cards->whereIn('set_code', $set_codes)->orderBy('card_id', 'asc');
        }

        $cards = $cards->paginate($pagination_num)->appends([
            'series' => $series_id,
        ]);

        return view('cards', compact('cards', 'series'));
    }
}
