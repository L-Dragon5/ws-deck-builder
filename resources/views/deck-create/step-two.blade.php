@extends('layouts.main')

@section('page_name', 'Build Deck')

@section('cdn')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Shuffle/5.2.1/shuffle.min.js"></script>
@endsection

@section('content')
<div class="loading-overlay bg-dark">
    <div class="lds-spinner"><div></div><div></div><div></div></div>
</div>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-4 col-xl-3">
            <span class="deck-create__building" data-series-id="{{ $series_id }}"><strong>Building: </strong>{{ $series_name }}</span>
        </div>
        <div class="col-md-8 col-xl-9 deck-create__info-container">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="deck-create__info">
                        Characters: <span class="deck-create__info__characters">0</span>
                    </div>
                    <div class="deck-create__info">
                        Events: <span class="deck-create__info__events">0</span>
                    </div>
                    <div class="deck-create__info">
                        Climaxes: <span class="deck-create__info__climaxes">0</span> / 8
                    </div>
                    <div class="deck-create__info">
                        Total: <span class="deck-create__info__total">0</span> / 50
                    </div>
                </div>

                <div class="row">
                    <button id="complete-deck-btn" class="btn btn-success form-control">Complete Deck</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5 col-lg-4 col-xl-3 sticky-top" style="max-height: 80vh; top: 4.5rem;">
            <h3>Deck</h3>
            <div class="deck-create__deck">
                <!-- Add list of cards in deck here -->
                <p>Waiting for cards</p>
            </div>
        </div>
        <div class="col-md-7 col-lg-8 col-xl-9 order-md-first">
            @include('deck-create.filter-options')
            @include('deck-create.list-cards', $cards)
        </div>
    </div>
</div>

@include('deck-create.details-modal')
@endsection