@if(count($characters) > 0)
    <h4>Character</h4>
    @include('deck-detail.list', ['cards' => $characters])
@endif


@if(count($events) > 0)
    <h4>Event</h4>
    @include('deck-detail.list', ['cards' => $events])
@endif


@if(count($climaxes) > 0)
    <h4>Climax</h4>
    @include('deck-detail.list', ['cards' => $climaxes])
@endif