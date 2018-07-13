<?php $exists = isset($event) ?>
@extends('layouts.app')
<link href="{{ asset('css/create.css') }}" rel="stylesheet">

@section('head-plus')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
@endsection

@section('content')
    <div class="container" id="all">
        <h1>Schedule Group Event</h1>
        <div class="col-xs-12" >
            @if(!$exists)
                {{Form::open(['route' => 'events.scheduleGroupEvent', 'method' => 'post'])}}
                    <div class="row">
                    {{Form::label('title')}}
                    </div>
                    <div class="row">
                    {{Form::text('title')}}
                    </div>
                    
                    <div class="row">
                    {{Form::label('Group Select') }}
                    </div>
                    <div class="row">
                    <select name="groupId" class="selectpicker" data-live-search="true" title="select group">
                        @foreach($groups as $g)
                            <option value="{{$g->id}}">{{$g->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    
                    <div class=row>
                    {{Form::label('date from')}}
                    </div>
                    <div class="row">
                    {{Form::date('dateFrom')}}
                    </div>
                    
                    <div class=row>
                    {{Form::label('date to')}}
                    </div>
                    <div class="row">
                    {{Form::date('dateTo')}}
                    </div>
                    
                    <div class=row>
                    {{Form::label('time start')}}
                    </div>
                    <div class="row">
                    {{Form::time('timeFrom')}}
                    </div>
                    
                    <div class=row>
                    {{Form::label('time end')}}
                    </div>
                    <div class="row">
                    {{Form::time('timeTo')}}
                    </div>
                    
                    <div class=row>
                    {{Form::submit('schedule')}}
                    </div>
                {{Form::close()}}
            @else
                {{Form::open(['route' => ['events.rescheduleGroupEvent', $event->id], 'method' => 'post'])}}
                    {{Form::label('title')}}
                    {{Form::text('title', $event->title)}}
                    <select name="groupId" class="selectpicker" data-live-search="true" title="select group">
                        @foreach($groups as $g)
                            @if($g->id == $groupSelected->id)
                                <option value="{{$g->id}}" selected>
                            @else
                                <option value="{{$g->id}}">
                            @endif
                                    {{$g->name}}
                                </option>
                        @endforeach
                    </select>
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