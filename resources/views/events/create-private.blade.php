@extends('layouts.app')

@section('content')
   
    <link rel="stylesheet" href="{{ secure_asset('css/create-private.css') }}">
    <div class="container">
        <h1>Schedule Private Event</h1>
        <div class="col-xs-12">

                {{Form::open(['route' => 'events.scheduleInPrivate', 'method' => 'post'])}}
                    
                    <div class="row">
                    {{Form::label('title')}}
                    </div>
                    <div class="row">
                    {{Form::text('title')}}
                    </div>
                    
                    <div class="row">
                    {{Form::label('date start')}}
                    </div>
                    <div class="row">
                    {{Form::date('dateFrom')}}
                    </div>
                    
                    <div class="row">
                    {{Form::label('date end')}}
                    </div><div class="row">
                    {{Form::date('dateTo')}}
                    </div>
                    
                    <div class="row">
                    {{Form::label('time start')}}
                    </div><div class="row">
                    {{Form::time('timeFrom')}}
                     </div>
              
                    
                    <div class="row">
                    {{Form::label('time end')}}
                    </div><div class="row">
                    {{Form::time('timeTo')}}
                    </div>
                    
                    <div class="row col-xs-2 col-xs-offset-5">
                    {{Form::submit('schedule')}}
                    </div>
                    
                    <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
    <input type="text" class="form-control" value="13:14">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
</div>
<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>
                
                {{Form::close()}}
                
        </div>
    </div>
    
    
@endsection