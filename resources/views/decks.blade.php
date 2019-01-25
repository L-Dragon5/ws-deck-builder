@extends('layouts.main')

@section('page_name', 'Home')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <h3>News & Updates</h3>
            <p>
                Hello! Welcome to a newly built deck builder for Weiss Schwarz.
                Things were put together very recently, so there might be a few bugs still crawling around.
                <br />Let us know if you find any problems.
            </p>

            @if(isset($featured_decks) && !empty($featured_decks))
            <h3>Featured Decks</h3>
            <div class="row mb-4">
                @foreach($featured_decks as $deck)
                <div class="col-sm-12 mb-3">
                    <a href="{{ url('/decks/' . $deck->id) }}" class="deck__card-link">
                        <div class="shadow card deck">
                            <div class="card-header">
                                <span>{{ $deck->name }}</span><br />
                                <small class="text-muted">{{ $deck->series_name }}</small>
                            </div>
                            @if(!empty($deck->win_location))
                            <div class="card-footer text-muted">
                                <p>
                                    <span class="deck__card__win-location">{{ $deck->win_location }}</span>
                                    -
                                    <span class="deck__card__win-date">@php echo date('M dS, Y', strtotime($deck->win_date)); @endphp</span>
                                </p>
                                <p>
                                    <span class="deck__card__win-participants">{{ $deck->win_participants }} people</span>
                                    -
                                    <span class="deck__card__win-result">{{ $deck->win_result }}</span>
                                </p>
                            </div>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="col-md-8">
            <h3>Decks</h3>
            <div class="row">
                @if(count($decks) > 0)
                    @foreach($decks as $deck)
                    <div class="col-md-6 mb-3">
                        <a href="{{ url('/decks/' . $deck->id) }}" class="deck__card-link">
                            <div class="shadow card deck">
                                <div class="card-header">
                                    <span>{{ $deck->name }}</span><br />
                                    <small class="text-muted">{{ $deck->series_name }}</small>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $deck->description }}</p>
                                </div>

                                @if(!empty($deck->win_location))
                                <div class="card-footer text-muted">
                                    <p>
                                        <span class="deck__card__win-location">{{ $deck->win_location }}</span>
                                        -
                                        <span class="deck__card__win-date">@php echo date('M dS, Y', strtotime($deck->win_date)); @endphp</span>
                                    </p>
                                    <p>
                                        <span class="deck__card__win-participants">{{ $deck->win_participants }} people</span>
                                        -
                                        <span class="deck__card__win-result">{{ $deck->win_result }}</span>
                                    </p>
                                </div>
                                @endif
                            </div>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>

            {{ $decks->appends(Request::except('page'))->links() }}
        </div>
    </div>
</div>
@endsection