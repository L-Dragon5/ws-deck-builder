@extends('layouts.main')

@section('page_name', 'Build Deck')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Neo-Standard Series</h3>
            <form action="{{ URL('/decks/create') }}" method="GET">
                <div class="form-group">
                    <select id="build-series" name="series" class="form-control">
                        <option value="0" disabled selected> - Choose a Series - </option>
                        @foreach($series as $s)
                            <option value="{{ $s->id }}">{{ $s->name_eng }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary mt-2">Choose</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection