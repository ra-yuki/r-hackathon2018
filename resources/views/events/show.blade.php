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
    @else {!! link_to_route('events.showRescheduleWithGroup', 'Reschedule', ['id'=>$event->id],['class'=>'btn btn-primary']) !!}
    @endif
    {!! Form::open(['route' => ['events.destroy', $event->id], 'method' => 'delete']) !!}
        <button class="btn btn-danger">Delete</button>
    {!! Form::close() !!}
    
    @if(!$event->fixed)
        {!! link_to_route('events.showHub', 'See Other Options', ['eventPath'=>$event->eventPath],['class'=>'btn btn-warning']) !!}
        {!! link_to_route('events.fix', 'Fix', ['id'=>$event->id],['class'=>'btn btn-danger']) !!}
    @endif
</div>
@endsection