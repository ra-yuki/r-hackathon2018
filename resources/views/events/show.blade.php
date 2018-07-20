@extends('layouts.app')

@section('head-plus')
    <link href="{{asset('css/commons/generals.css')}}">
@endsection

@section('content')
<div class="container">
    @include('commons.messages')
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <h1>{{$event->title}}</h1>
        <h4> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. {{$event->description}}</h4>
        <div id="date-time" class="">
            <div id="clock" class="col-xs-1" style="padding: 0px;">
                <h2><span class="glyphicon glyphicon-time"></span></h2>
            </div>
            <div id="date-from" class="col-xs-2" style="padding: 0px;">
                <h4>2018-09-07</h4>
                <h5>09:00</h5>
                {{-- {{$event->dateTimeFromSelf}} --}}
            </div>
            <div id="from-to" class="col-xs-1" style="padding: 0px;">
                ~
            </div>
            <div id="date-to" class="col-xs-2" style="padding: 0px;">
                <h4>2018-09-07</h4>
                <h5>11:00</h5>
                {{-- {{$event->dateTimeToSelf}} --}}
            </div>
        </div>
        <!--<ul>-->
        <!--    <li>START | {{$event->dateTimeFromSelf}}</li>-->
        <!--    <li>END | {{$event->dateTimeToSelf}}</li>-->
        <!--</ul>-->
        {{-- @if($event->fixed) {!! link_to_route('events.edit', 'Edit', ['id'=>$event->id],['class'=>'btn btn-primary']) !!}
        @else {!! link_to_route('events.showRescheduleWithGroup', 'Reschedule', ['id'=>$event->id],['class'=>'btn btn-primary']) !!}
        @endif
        {!! Form::open(['route' => ['events.destroy', $event->id], 'method' => 'delete']) !!}
            <button class="btn btn-danger">Delete</button>
        {!! Form::close() !!} --}}
    
    </div>
</div>
@endsection