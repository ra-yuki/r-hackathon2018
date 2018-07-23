<?php 
$fromSet = explode(' ', $event->dateTimeFromSelf);
$toSet = explode(' ', $event->dateTimeToSelf);
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Private Event</h1>
        <div class="col-xs-12">
            {{Form::open(['route' => ['events.update', $event->id], 'method' => 'put'])}}
                {{Form::label('title')}}
                {{Form::text('title', $event->title)}}
                {{Form::label('description')}}
                {{Form::text('description', $event->description)}}
                {{Form::label('date start')}}
                {{Form::date('dateFrom', $fromSet[0])}}
                {{Form::label('date end')}}
                {{Form::date('dateTo', $toSet[0])}}
                {{Form::label('time start')}}
                {{Form::time('timeFrom', $fromSet[1])}}
                {{Form::label('time end')}}
                {{Form::time('timeTo', $toSet[1])}}
            
                {{Form::submit('Update')}}
            {{Form::close()}}
        </div>
    </div>
@endsection