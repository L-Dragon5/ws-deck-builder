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