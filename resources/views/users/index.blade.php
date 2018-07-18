@extends('layouts.app')
@section('head-plus')
    <link rel="stylesheet" href ="{{ secure_asset('css/calendar.css') }}">
@endsection
@section('content')

<div id="wrapper-top" class="container">
    <div class="col-xs-12 col-md-8">
        <h1>
            <a href="{{route('mypage.index')}}?year={{$yearPrev}}&month={{$monthPrev}}" class="btn btn-link"><</a>
            {{$year}}/{{$month}}
            <a href="{{route('mypage.index')}}?year={{$yearNext}}&month={{$monthNext}}" class="btn btn-link">></a>
        </h1>
        
        <div id="tableWrapper-top" class="col-xs-12">
            @include('commons.calendar', [
                'year' => $year,
                'month' => $month,
                'days' => $days,
                'holidays' => $holidays,
            ])
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <h1>Unfixed Events</h1>
        @include('commons.unfixedEvents', [
            'events' => $eventsUnfixed,
        ])
    </div>
</div>
@endsection