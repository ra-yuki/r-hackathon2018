@extends('layouts.app')
@section('head-plus')
    <link rel="stylesheet" href ="{{ secure_asset('css/calendar.css') }}">
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
        @include('commons.unfixedEvents', [
            'events' => $eventsUnfixed,
        ])
    </div>
     <!--<div class="dropdown">-->
     <!--       <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="month">-->
     <!--       Select Month <span class="glyphicon glyphicon-triangle-bottom"></span>-->
     <!--     </button>-->
     <!--      choices -->
     <!--     <ul class="dropdown-menu">-->
        
     <!--        <li><a href="{{route('mypage.index')}}?year=2019&month=01">January</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2019&month=02">Febuary</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2019&month=03">March</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2019&month=04">April</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2019&month=05">May</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2019&month=06">June</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2018&month=07">July</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2018&month=08">August</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2018&month=09">September</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2018&month=10">October</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2018&month=11">November</a></li>-->
     <!--        <li><a href="{{route('mypage.index')}}?year=2018&month=12">December</a></li>-->
     <!--     </ul>-->
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <form>
              <p class="see">See Other Months Schedule</p>
              <input type="text" name="year" placeholder="Year" id="hako" value="{{(new DateTime())->format('Y')}}">
              
              <input type="number" name="month" placeholder="Month" id="hako" value="{{(new DateTime())->format('m')}}">
            
              
              <button id="go">go</button>
          </form>
        </div>
</div>
@endsection