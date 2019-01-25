@if(count($cards > 0))
    <ul class="deck-create__deck__list">

    @if(isset($cards['levels']))
        @if(isset($cards['levels']['zero']) && !empty($cards['levels']['zero']))
            <li>Level 0</li>
            <ul>
                @include('deck-create.list-deck-lists-piece', ['cards' => $cards['levels']['zero']])
            </ul>
        @endif

        @if(isset($cards['levels']['one']) && !empty($cards['levels']['one']))
            <li>Level 1</li>
            <ul>
                @include('deck-create.list-deck-lists-piece', ['cards' => $cards['levels']['one']])
            </ul>
        @endif

        @if(isset($cards['levels']['two']) && !empty($cards['levels']['two']))
            <li>Level 2</li>
            <ul>
                @include('deck-create.list-deck-lists-piece', ['cards' => $cards['levels']['two']])
            </ul>
        @endif

        @if(isset($cards['levels']['three']) && !empty($cards['levels']['three']))
            <li>Level 3+</li>
            <ul>
                @include('deck-create.list-deck-lists-piece', ['cards' => $cards['levels']['three']])
            </ul>
        @endif
    @else
        @include('deck-create.list-deck-lists-piece', $cards)
    @endif

    </ul>
@endif