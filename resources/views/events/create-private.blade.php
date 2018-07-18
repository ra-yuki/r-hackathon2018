@extends('layouts.app')

@section('content')
   
    <link rel="stylesheet" href="{{ secure_asset('css/create-private.css') }}">
    <div class="container">
        <h1>Schedule Private Event</h1>
        <div class="col-xs-12">

                {{Form::open(['route' => 'events.scheduleInPrivate', 'method' => 'post'])}}
                    
                    <div class="row ">
                    {{Form::label('title')}}
                    </div>
                    <div class="row">
                    {{Form::text('title',null,['class' => 'maru'])}}
                    </div>
                    
                    <p></p>
                    <div class="row">
                    {{Form::label('date start')}}
                    </div>
                    <div class="row">
                    {{Form::date('dateFrom',null,['class' => 'maru'])}}
                    </div>
                    
                    <p></p>
                    <div class="row">
                    {{Form::label('date end')}}
                    </div>
                    <div class="row">
                    {{Form::date('dateTo',null,['class' => 'maru'])}}
                    </div>
                    
                    <p></p>
                    <div class="row">
                    {{Form::label('time start')}}
                    </div>
                    <div class="row">
                    <div class="input-group clockpicker col-xs-5 col-sm-3 col-md-2 col-lg-2 " data-placement="right" data-align="top" data-autoclose="true">
                        <input type="text" class="form-control" value="00:00">
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
                    </div><div class="row">
                    <div class="input-group clockpicker col-xs-5 col-sm-3 col-md-2 col-lg-2" data-placement="right" data-align="top" data-autoclose="true">
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
                
        </div>
    </div>
    
    
@endsection