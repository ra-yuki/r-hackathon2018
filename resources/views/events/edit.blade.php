<?php 
$fromSet = explode(' ', $event->dateTimeFromSelf);
$toSet = explode(' ', $event->dateTimeToSelf);
?>

@extends('layouts.app')

@section('head-plus')
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    <link href="{{ asset('css/commons/buttons.css') }}" rel="stylesheet"
    <!--calender -->
 
@endsection

@section('content')
    <div class="container">
        <h1>Edit Private Event</h1>
        <div class="col-xs-12">
            {{Form::open(['route' => ['events.update', $event->id], 'method' => 'put'])}}
                <div class="row">
                    {{Form::label('title')}}
                </div>
                
                <div class="row">
                    <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2 waku">
                        {{Form::text('title', $event->title)}}
                    </div>
                </div>    
                
                <p></p>
                <div class="row">
                    {{Form::label('memo')}}
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 waku">
                        {{Form::text('description', $event->description)}}
                    </div>
                </div>
                
                <p></p>
                <div class="row">
                    {{Form::label('date start')}}
                </div>
                
                <div class="row">
                    <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                        {{Form::date('dateFrom', $fromSet[0])}}
                    </div>
                </div>
                
                <p></p>
                <div class="row">
                    {{Form::label('date end')}}
                </div>
                
                <div class="row">
                    <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                        {{Form::date('dateTo', $toSet[0])}}
                    </div>
                </div>
                
                <p></p>
                <div class="row">
                    {{Form::label('time start')}}
                </div>
                
                <div class="row">
                    <div class="input-group clockpicker col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                        <input type="time" class="form-control" value="{{$fromSet[1]}}" name="timeFrom">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                    </div>
                    <script type="text/javascript">
                        $('.clockpicker').clockpicker();
                    </script>
                </div>
                    
                <p></p>
                <div class="row">
                    {{Form::label('time end')}}
                </div>
                
                 <div class="row">
                    <div class="input-group clockpicker  col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                        <input type="time" class="form-control" value="{{$toSet[1]}}" name="timeTo">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                    </div>
                    <script type="text/javascript">
                        $('.clockpicker').clockpicker();
                    </script>
                </div>

                <p></p>
                <div class="row col-xs-2 col-xs-offset-3">
                    <button class="btn btn-grey">Update</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
@endsection