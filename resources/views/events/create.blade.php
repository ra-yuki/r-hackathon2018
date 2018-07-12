<?php $exists = isset($event) ?>
@extends('layouts.app')

@section('head-plus')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
@endsection

@section('content')
    <div class="container">
        <h1>Schedule Group Event</h1>
        <div class="col-xs-12">
            @if(!$exists)
                {{Form::open(['route' => 'events.scheduleGroupEvent', 'method' => 'post'])}}
                    {{Form::label('title')}}
                    {{Form::text('title')}}
                    <select name="groupId" class="selectpicker" data-live-search="true" title="select group">
                        @foreach($groups as $g)
                            <option value="{{$g->id}}">{{$g->name}}</option>
                        @endforeach
                    </select>

                    {{Form::label('date from')}}
                    {{Form::date('dateFrom')}}
                    {{Form::label('date to')}}
                    {{Form::date('dateTo')}}
                    {{Form::label('time start')}}
                    {{Form::time('timeFrom')}}
                    {{Form::label('time end')}}
                    {{Form::time('timeTo')}}
        
                    {{Form::submit('schedule')}}
                {{Form::close()}}
            @else
                {{Form::open(['route' => ['events.rescheduleGroupEvent', $event->id], 'method' => 'post'])}}
                    {{Form::label('title')}}
                    {{Form::text('title', $event->title)}}
                    {{Form::label('group ID')}}
                    {{Form::number('groupId', $groupId)}}
                    {{Form::label('date from')}}
                    {{Form::date('dateFrom', $event->dateFrom)}}
                    {{Form::label('date to')}}
                    {{Form::date('dateTo', $event->dateTo)}}
                    {{Form::label('time start')}}
                    {{Form::time('timeFrom', $event->timeFrom)}}
                    {{Form::label('time end')}}
                    {{Form::time('timeTo', $event->timeTo)}}
        
                    {{Form::submit('Reschedule')}}
                {{Form::close()}}
            @endif
        </div>
    </div>
@endsection