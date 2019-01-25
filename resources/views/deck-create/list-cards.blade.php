@if(count($cards) > 0)
    <div id="card-grid" class="deck-create__card-container">
        @foreach($cards as $card)
        <div class="deck-create__card__shuffle"
            data-type="{{ $card->type }}"
            data-color="{{ $card->color }}"
            data-id="{{ $card->card_id }}"
            data-name="{{ $card->name_eng }}"
            data-level="{{ $card->level }}">
            <div class="card deck-create__card bg-dark text-white mb-2">
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
                " class="card-img deck-create__card__image deck-create__card__image--{{ $card->type }}" />
                <div class="card-img-overlay">                    
                    @if($card->type == "Character" || $card->type == "Event")
                    <table class="deck-create__card__table card-table my-2"> 
                        <tr>
                            <td><strong>L:</strong> {{ $card->level }}</td>
                            <td><strong>C:</strong> {{ $card->cost }}</td>
                        </tr>
                        
                        @if($card->type == "Character")
                        <tr>
                            <td><strong>P:</strong> {{ $card->power }}</td>
                            <td><strong>S:</strong> {{ $card->soul }}</td>
                        </tr>
                        @endif
                    </table>
                    @else
                    <br /><br />
                    @endif

                    <div class="btn-group-vertical deck-create__card__links">
                        <a href="https://ws-tcg.com/cardlist/?cardno={{ $card->card_id }}" class="btn btn-info" target="_blank"><i class="fas fa-info"></i></a>
                        <a href="https://heartofthecards.com/code/cardlist.html?card=WS_{{ $card->card_id }}" class="btn btn-primary" target="_blank"><i class="fas fa-language"></i></a>
                    </div>
                </div>
                <div class="card-img-overlay-overlay">
                    <div class="deck-create__card-plus"
                        data-card-id="{{ $card->card_id }}"
                        data-card-type="{{ $card->type }}">
                        <i class="fas fa-plus"></i>
                    </div>

                    <div class="deck-create__card-minus"
                        data-card-id="{{ $card->card_id }}"
                        data-card-type="{{ $card->type }}">
                        <i class="fas fa-minus"></i>
                    </div>
                </div>
                <div class="deck-create__card__footer deck-create__card__footer--{{ $card->type }} card-footer">
                    <span class="float-left deck-create__card-quantity" data-id="{{ $card->card_id }}">0</span>
                    <h5 class="deck-create__card__title card-title" data-toggle="tooltip" title="{{ $card->name_eng }}">{{ $card->name_eng }}</h5>
                    <h6 class="card-subtitle">{{ $card->card_id }}</h6>
                </div>
            </div>
        </div>               
        @endforeach
    </div>
@else
    <div class="deck-create__card-container">
        <h3>No cards found</h3>
    </div>
@endif