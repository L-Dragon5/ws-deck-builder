@foreach($cards as $c)
    @php $card = $c['card']; $quantity = $c['quantity']; @endphp
    <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
        <div class="shadow clearfix deck-detail__card-block__card">
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
        " class="float-left mr-3 card-img deck-detail__card__image deck-detail__card__image--{{ $card->type }}" />
        
            <div class="deck-detail__card__information">
                <h4 class="deck-detail__card-quantity">{{ $quantity }}x</h4>
                <h5 class="deck-detail__card__title">{{ $card->name_eng }}</h5>
                <h6 class="card-subtitle">{{ $card->card_id }}</h6>

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

                <div class="btn-group-vertical deck-detail__card__links">
                    <a href="https://ws-tcg.com/cardlist/?cardno={{ $card->card_id }}" class="btn btn-info" target="_blank"><i class="fas fa-info"></i> WS-TCG</a>
                    <a href="https://heartofthecards.com/code/cardlist.html?card=WS_{{ $card->card_id }}" class="btn btn-primary" target="_blank"><i class="fas fa-language"></i> HotC</a>
                </div>
            </div>
        </div>
    </div>
@endforeach