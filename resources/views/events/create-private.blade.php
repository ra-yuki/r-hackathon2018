@extends('layouts.app')

@section('head-plus')
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
<<<<<<< HEAD
    <link href="{{ asset('css/commons/buttons.css') }}" rel="stylesheet"
=======
    <link href="{{ asset('css/commons/buttons.css') }}" rel="stylesheet">
>>>>>>> b22bd8fc81d93f71383b221691635966c29e475d
@endsection

@section('content')
   <div class="container" id="all">
        <h1>Schedule Private Event</h1><br>
        
        <div class="col-xs-12" >
                {{Form::open(['route' => 'events.scheduleInPrivate', 'method' => 'post'])}}
                    <div class="row">
                        {{Form::label('title')}}
                    </div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2 waku">
                           {{Form::text('title',null,['class' => 'form-control','placeholder' => 'ex.) Drive'])}}
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('Memo')}}
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 waku">
                           {{Form::text('description',null,['class' => 'form-control','placeholder' => 'ex.) Go to Atami with my family'])}}
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('date start')}}
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            {{Form::date('dateFrom',$date,['class' => 'form-control'])}}
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        
                            {{Form::label('date end')}}
                       
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            {{Form::date('dateTo',$date,['class' => 'form-control'])}}
                        </div>
                    </div>
                
                    <p></p>
                    <div class="row">
                        {{Form::label('time start')}}
                    </div>
                    <div class="row">
                        <div class="input-group clockpicker col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                            <input type="time" class="form-control" value="00:00" name="timeFrom">
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
                            <input type="time" class="form-control" value="00:00" name="timeTo">
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
                    <button class="btn" id="cre">create</button>
                    </div>
                {{Form::close()}}
           
        </div>
    </div>
   
@endsection