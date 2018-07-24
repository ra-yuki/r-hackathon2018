@extends('layouts.app')
@section('head-plus')
    <link rel="stylesheet" href ="{{ secure_asset('css/calendar.css') }}">
    <link rel="stylesheet" href ="{{ secure_asset('css/mypage.css') }}">
@endsection
@section('content')

<div id="wrapper-top" class="container">
    @include('commons.messages')
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
        <div id="unfix" class="panel panel-default">
        @include('commons.unfixedEvents', [
            'events' => $eventsUnfixed,
        ])
        </div>
    </div>
    
    <div class="col-xs-12 col-md-4">
        <form>
            <p class="see">See Other Months Schedule</p>
            <input type="number" name="year" placeholder="Year" id="hako" value="{{(new DateTime())->format('Y')}}">
            
            <input type="number" name="month" placeholder="Month" id="hako" value="{{(new DateTime())->format('m')}}">
            
            <button id="go">go</button>
        </form>
    </div>
</div>
@endsection