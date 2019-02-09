@foreach($cards as $c)
    @php $card = $c['card']; $quantity = $c['quantity']; @endphp
    <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
        <a class="deck-detail__card-block__link" href="https://heartofthecards.com/code/cardlist.html?card=WS_{{ $card->card_id }}" target="_blank">
            <div class="shadow clearfix deck-detail__card-block__card deck-detail__card-block__card--{{ $card->color }}">        
                <div class="deck-detail__card__information">
                    <div class="deck-detail__card__information--one">
                        <h4 class="deck-detail__card-quantity">{{ $quantity }}x</h4>
                    </div>
                    <div class="deck-detail__card__information--two">
                        <h5 class="deck-detail__card__title">{{ $card->name_eng }}</h5>
                        <h6 class="card-subtitle">{{ $card->card_id }}</h6>
                    </div>

                    @if($card->type == "Character" || $card->type == "Event")
                    <table class="deck-detail__card__table card-table my-2"> 
                        <tr>
                            <td><strong>Level:</strong> {{ $card->level }}</td>
                            <td><strong>Cost:</strong> {{ $card->cost }}</td>
                        </tr>
                        
                        @if($card->type == "Character")
                        <tr>
                            <td><strong>Power:</strong> {{ $card->power }}</td>
                            <td><strong>Soul:</strong> {{ $card->soul }}</td>
                        </tr>
                        @endif
                    </table>
                    @else
                    <br /><br />
                    @endif
                </div>
            </div>
        </a>
    </div>
@endforeach