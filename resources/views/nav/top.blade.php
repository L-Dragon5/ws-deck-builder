<nav class="navbar navbar-expand-md sticky-top navbar-dark bg-dark">
    <a class="navbar-brand" href="./">{{ config('app.name') }}</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
            <a class="nav-item nav-link {{ Request::is('/decks/create') ? 'active' : '' }}" href="{{ url('/decks/create') }}">Build Deck</a>
            <a class="nav-item nav-link {{ Request::is('/cards') ? 'active' : '' }}" href="{{ url('/cards') }}">Cards</a>
            <a class="nav-item nav-link disabled {{ Request::is('/tools') ? 'active' : '' }}" href="{{ url('/tools') }}">Tools</a>
        </div>
    </div>
</nav>