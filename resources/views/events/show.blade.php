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
    
    @if(!$event->fixed)
        <div class="col-xs-12">
            <h1>Other dates available</h1>
            <div class="col-xs-12">
                @foreach($eventOtherOptions as $eo)
                    {!! link_to_route('events.show', $eo->dateTimeFromSelf . " ~ " . $eo->dateTimeToSelf, ['id' => $eo->id], ['class' => "btn btn-block btn-warning"]) !!}
                @endforeach
            </div>
                <div class="col-xs-12">
                <a class="btn btn-danger" href="#">Fix</a>
            </div>
        </div>
    @endif
</div>
@endsection