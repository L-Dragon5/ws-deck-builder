@if(count($characters) > 0 || count($events) > 0 || count($climaxes) > 0)
    <h5>Character</h5>
    @include('deck-create.list-deck-lists', ['cards' => $characters])

    <h5>Event</h5>
    @include('deck-create.list-deck-lists', ['cards' => $events])

    <h5>Climax</h5>
    @include('deck-create.list-deck-lists', ['cards' => $climaxes])
@else
    <p>Waiting for cards</p>
@endif