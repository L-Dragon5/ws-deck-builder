@extends('layouts.main')

@section('page_name', 'Cards')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-xl-2">
            <h3>Filter</h3>
            <form>
                <div class="form-group">
                    <label for="filter-series">Neo-Standard Series</label>
                    <select id="filter-series" class="form-control">
                        <option value="0" disabled selected> - Choose a Series - </option>
                        @foreach($series as $s)
                            <option value="{{ $s->id }}" 
                                @php
                                if(isset($_GET['series']) && $_GET['series'] == $s->id) {
                                    echo 'selected';
                                }
                                @endphp
                            >{{ $s->name_eng }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="col-md-9 col-xl-10">
            <h3>Cards</h3>
            <div class="container-fluid">
                <div class="row">
                    @if(count($cards) > 0)
                        @foreach($cards as $card)
                        <div class="col-md-12 col-lg-6 col-xl-4 mb-4">
                            <div class="shadow card card-row card--{{ $card->color }}">
                                <div class="card-body">
                                    <h5 class="card-title" data-toggle="tooltip" title="{{ $card->name_eng }}">{{ $card->name_eng }}</h5>
                                    <h6 class="card-subtitle">{{ $card->card_id }}</h6>
                                    <table class="card-table my-3"> 
                                        <tr>
                                            <td><strong>Level</strong> {{ $card->level }}</td>
                                            <td><strong>Cost</strong> {{ $card->cost }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Power</strong> {{ $card->power }}</td>
                                            <td><strong>Soul</strong> {{ $card->soul }}</td>
                                        </tr>
                                    </table>       

                                    <a href="https://ws-tcg.com/cardlist/?cardno={{ $card->card_id }}" class="card-link" target="_blank">WS-TCG</a><br />
                                    <a href="https://heartofthecards.com/code/cardlist.html?card=WS_{{ $card->card_id }}" class="card-link" target="_blank">Translation</a>
                                </div>

                                <img src="
                                    @php
                                        $card_id = strtolower(str_replace('/', '_', str_replace('-', '_', $card->card_id))) . '.jpg';
                                        $loc = "storage/cards/$card_id";
                                        if(file_exists($loc)) {
                                            echo asset($loc);
                                        } else {
                                            if($card->type == "Climax") {
                                                echo asset("storage/cards/dc_w00_000.jpg");
                                            } else {
                                                echo asset("storage/cards/dc_w00_00.jpg");
                                            }
                                        }
                                    @endphp
                                " class="card-image card-image--{{ $card->type }}" />
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            {{ $cards->appends(Request::except('page'))->links() }}
        </div>
    </div>
</div>
@endsection