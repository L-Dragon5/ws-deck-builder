@extends('layouts.main')

@section('page_name', $deck->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        @if(!empty($deck->win_location))
        <div class="col-md-7">
        @else
        <div class="col-md-10">
        @endif
            <h1>{{ $deck->name }}</h1>
            <h4 class="text-muted">{{ $series_name }}</h4>
            <div class="mb-3">
                Created at: @php echo date('M dS, Y', strtotime($deck->created_at)); @endphp
                &nbsp;&nbsp;-&nbsp;&nbsp;
                Updated at: @php echo date('M dS, Y', strtotime($deck->updated_at)); @endphp
            </div>
        </div>

        @if(!empty($deck->win_location))
        <div class="col-md-3">
            <h5>Winning Deck Results</h5>
            <table class="deck-detail__win__table">
            <tbody>
            <tr>
                <td>Location</td>
                <td>{{ $deck->win_location }}</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>@php echo date('M dS, Y', strtotime($deck->win_date)); @endphp</td>
            </tr>
            <tr>
                <td>Participants</td>
                <td>{{ $deck->win_participants }}</td>
            </tr>
            <tr>
                <td>Result</td>
                <td>{{ $deck->win_result }}</td>
            </tr>
            </tbody>
            </table>
        </div>
        @endif

        <div class="col-md-2 text-center">
            <div class="btn-group-vertical" role="group" aria-label="Deck actions">
                <button type="button" class="btn btn-outline-primary disabled">Edit</button>
                <button type="button" class="btn btn-outline-secondary disabled">Print Deck List</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div id="deck-detail-list" class="mb-4" style="display: none;">{{ $deck->deck }}</div>
        </div>
    </div>
</div>
@endsection