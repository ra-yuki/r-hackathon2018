@extends('layouts.app')

@section('content')

<div id="wrapper-top" class="container">
    <h1>
        <a href="{{route('mypage.index')}}?year={{$yearPrev}}&month={{$monthPrev}}" class="btn btn-primary"><</a>
        {{$year}}/{{$month}}
        <a href="{{route('mypage.index')}}?year={{$yearNext}}&month={{$monthNext}}" class="btn btn-primary">></a>
    </h1>
    
    <div id="tableWrapper-top" class="col-xs-12">
        @include('commons.calendar', [
            'year' => $year,
            'month' => $month,
            'days' => $days,
            'holidays' => $holidays,
        ])
    </div>
    <div class="col-xs-12">
        <h1>Unfixed Events</h1>
        @include('commons.unfixedEvents', [
            'events' => $eventsUnfixed,
        ])
    </div>
</div>
@endsection