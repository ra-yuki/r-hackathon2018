@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-xs-12">
        <h1>TITLE | {{$event->title}}</h1>
        <h3>DESCRIPTION | {{$event->description}}</h3>
        <ul>
            <li>START | {{$event->dateTimeFromSelf}}</li>
            <li>END | {{$event->dateTimeToSelf}}</li>
        </ul>
    </div>
    @if($event->fixed) {!! link_to_route('events.edit', 'Edit', ['id'=>$event->id],['class'=>'btn btn-primary']) !!}
    @else {!! link_to_route('events.showRescheduleGroupEvent', 'Reschedule', ['id'=>$event->id],['class'=>'btn btn-primary']) !!}
    @endif
    {!! Form::open(['route' => ['events.destroy', $event->id], 'method' => 'delete']) !!}
        <button class="btn btn-danger">Delete</button>
    {!! Form::close() !!}
    
    @if(!$event->fixed)
        <div class="col-xs-12">
            <h1>Other dates available</h1>
            <div class="col-xs-12">
                @foreach($eventOtherOptions as $eo)
                    {!! link_to_route('events.show', $eo->dateTimeFromSelf . " ~ " . $eo->dateTimeToSelf, ['id' => $eo->id], ['class' => "btn btn-block btn-warning"]) !!}
                @endforeach
            </div>
                <div class="col-xs-12">
                {!! link_to_route('events.fix', 'Fix', ['id'=>$event->id],['class'=>'btn btn-danger']) !!}
            </div>
        </div>
    @endif
</div>
@endsection