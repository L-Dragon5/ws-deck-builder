@foreach($cards as $c)
    @php $card = $c['card']; $quantity = $c['quantity']; @endphp
    <li class="deck-create__deck__card card--{{ $card->color }}" data-toggle="tooltip" title="{{ $card->card_id }}">
        {{ $quantity }}x - {{ $card->name_eng }}
    </li>
@endforeach