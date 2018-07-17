<?php $exists = isset($event) ?>
@extends('layouts.app')

@section('head-plus')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container" id="all">
        <h1>Schedule Group Event</h1>
        <div class="col-xs-12　" >
            @if(!$exists)
                {{Form::open(['route' => 'events.scheduleWithGroup', 'method' => 'post'])}}
                    
                        <div class="row">
                            {{Form::label('title')}}
                        </div>
                        <div class="row">
                            <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2 waku">
                               {{Form::text('title',null,['class' => 'form-control'])}}
                            </div>
                        </div>
                   
                    
                    <div class="row">
                    {{Form::label('Group Select') }}
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-3 col-md-2 col-lg-2 waku">
                    <select name="groupId" class="selectpicker" data-live-search="true" title="select group">
                        @foreach($groups as $g)
                            <option value="{{$g->id}}">{{$g->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    </div>
                    
                    <div class="row">
                        {{Form::label('date from')}}
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            {{Form::date('dateFrom',null,['class' => 'form-control'])}}
                        </div>
                    </div>
                    
                    <div class="row">
                        
                            {{Form::label('date to')}}
                       
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            {{Form::date('dateTo',null,['class' => 'form-control'])}}
                        </div>
                    </div>
                    
                    <div class="row">
                        {{Form::label('time start')}}
                    </div>
                    <div class="row">
                        <div class="input-group clockpicker col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                            <input type="text" class="form-control" value="00:00">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                        </div>
                        <script type="text/javascript">
                            $('.clockpicker').clockpicker();
                        </script>
                    </div>
                    
                    <div class="row">
                        {{Form::label('time end')}}
                    </div>
                    <div class="row">
                        <div class="input-group clockpicker  col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                            <input type="text" class="form-control" value="00:00">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                        </div>
                        <script type="text/javascript">
                            $('.clockpicker').clockpicker();
                        </script>
                    </div>
                    
                    <div class="row col-xs-2 col-xs-offset-5">
                    {{Form::submit('schedule')}}
                    </div>
                {{Form::close()}}
            @else
                {{Form::open(['route' => ['events.rescheduleWithGroup', $event->id], 'method' => 'post'])}}
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