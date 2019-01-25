@if(count($cards > 0))
    <div class="deck-detail__card-block">

    @if(isset($cards['levels']))
        @if(isset($cards['levels']['zero']) && !empty($cards['levels']['zero']))
            <h5>Level 0</h5>
            <div class="row deck-detail__card-block__card-list">
                @include('deck-detail.list-piece', ['cards' => $cards['levels']['zero']])
            </div>
        @endif

        @if(isset($cards['levels']['one']) && !empty($cards['levels']['one']))
            <h5>Level 1</h5>
            <div class="row deck-detail__card-block__card-list">
                @include('deck-detail.list-piece', ['cards' => $cards['levels']['one']])
            </div>
        @endif

        @if(isset($cards['levels']['two']) && !empty($cards['levels']['two']))
            <h5>Level 2</h5>
            <div class="row deck-detail__card-block__card-list">
                @include('deck-detail.list-piece', ['cards' => $cards['levels']['two']])
            </div>
        @endif

        @if(isset($cards['levels']['three']) && !empty($cards['levels']['three']))
            <h5>Level 3+</h5>
            <div class="row deck-detail__card-block__card-list">
                @include('deck-detail.list-piece', ['cards' => $cards['levels']['three']])
            </div>
        @endif
    @else
        <div class="row">
            @include('deck-detail.list-piece', $cards)
        </div>
    @endif

    </div>
@endif