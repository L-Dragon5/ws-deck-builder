<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Card;
use App\Deck;
use App\Series;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination_num = 15;
        $series = Series::orderBy('name_eng', 'asc')->get();
        $featured_decks = null;
        $decks = new Deck;
        $series_id = null;

        if($request->has('series')) {
            $series_id = filter_var($request->query('series'), FILTER_SANITIZE_NUMBER_INT);;
            $set_codes = json_decode(Series::where('id', $series_id)->pluck('set_codes')[0]);
            $decks = $decks->whereIn('series_id', $set_codes)->orderBy('updated_at', 'desc');
        }

        $decks = $decks->orderBy('updated_at', 'desc')->paginate($pagination_num)->appends([
            'series' => $series_id,
        ]);

        foreach($decks as $deck) {
            $deck->series_name = Series::find($deck->series_id)->name_eng;
        }

        /* Uncomment to add featured decks */
        $featured_decks = Deck::find([1, 2]);
        foreach($featured_decks as $deck) {
            $deck->series_name = Series::find($deck->series_id)->name_eng;
        }

        return view('decks', compact('decks', 'series', 'featured_decks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Check if Series has been selected yet
        // If so, show create2 with the actual card selection
        // If not, get series information to start
        if($request->has('series')) {
            $series_id = filter_var($request->query('series'), FILTER_SANITIZE_NUMBER_INT);
            $series_name = Series::find($series_id)->name_eng;
            $set_codes = json_decode(Series::where('id', $series_id)->pluck('set_codes')[0]);

            $cards = Card::whereIn('set_code', $set_codes)
                            ->orderBy('card_id', 'asc')
                            ->get();
        
            return view('deck-create.step-two', compact('cards', 'series_id', 'series_name'));
        } else {
            $series = Series::orderBy('name_eng', 'asc')->get();

            return view('deck-create.step-one', compact('series'));
        }
    }

    /**
     * Grab all cards from series
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDeckList(Request $request) {
        // 1st is used by Deck Create
        // 2nd is used by Deck Detail
        if($request->isMethod('post') && $request->has('cards')) {
            $cards = $request->input('cards');
            $characters = $events = $climaxes = array();

            if(isset($cards['characters'])) { $characters = $this->setupArray($cards['characters'], true); }
            if(isset($cards['events'])) { $events = $this->setupArray($cards['events'], true); }
            if(isset($cards['climaxes'])) { $climaxes = $this->setupArray($cards['climaxes']); }

            return view('deck-create.list-deck', compact('characters', 'events', 'climaxes'))->render();
        } else if($request->isMethod('post') && $request->has('deck-detail')) {
            $cards = $request->input('deck-detail');
            $characters = $events = $climaxes = array();

            if(isset($cards['characters'])) { $characters = $this->setupArray($cards['characters'], true); }
            if(isset($cards['events'])) { $events = $this->setupArray($cards['events'], true); }
            if(isset($cards['climaxes'])) { $climaxes = $this->setupArray($cards['climaxes']); }

            return view('deck-detail.detail-list', compact('characters', 'events', 'climaxes'))->render();
        }
    }

    private function setupArray($arr, $levels = false) {
        $temp = array_count_values($arr);
        ksort($temp);
        $ret = array();

        if($levels) {
            foreach($temp as $k => $v) {
                $card = Card::where('card_id', $k)->first();
                if($card->level == 0) {
                    $ret['levels']['zero'][$k]['card'] = $card;
                    $ret['levels']['zero'][$k]['quantity'] = $v;
                } else if($card->level == 1) {
                    $ret['levels']['one'][$k]['card'] = $card;
                    $ret['levels']['one'][$k]['quantity'] = $v;
                } else if($card->level == 2) {
                    $ret['levels']['two'][$k]['card'] = $card;
                    $ret['levels']['two'][$k]['quantity'] = $v;
                } else {
                    $ret['levels']['three'][$k]['card'] = $card;
                    $ret['levels']['three'][$k]['quantity'] = $v;
                }
            }
        } else {
            foreach($temp as $k => $v) {
                $ret[$k]['card'] = Card::where('card_id', $k)->first();
                $ret[$k]['quantity'] = $v;
            }
        }

        return $ret;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post') && $request->has('deck')) {
            $user_deck = $request->input('deck');
            $deck = new Deck();
            $deck->series_id = $user_deck['series_id'];
            $deck->name = $user_deck['name'];
            $deck->description = $user_deck['description'];
            
            if($user_deck['win']['check']) {
                $deck->win_location = $user_deck['win']['location'];
                $deck->win_date = $user_deck['win']['date'];
                $deck->win_participants = $user_deck['win']['participants'];
                $deck->win_result = $user_deck['win']['result'];
            }

            $deck->deck = json_encode($user_deck['cards']);
            $deck->hash = Hash::make($user_deck['password']);

            if($deck->save()) {
                return $deck->id;
            } else {
                return response()->json(['error' => 'Could not save to database.'], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deck = Deck::find($id);
        $series_name = Series::find($deck->series_id)->name_eng;

        return view('deck-detail.detail', compact('deck', 'series_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
