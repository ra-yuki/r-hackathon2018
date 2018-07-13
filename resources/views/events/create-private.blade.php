@extends('layouts.app')

@section('content')
   
    <link rel="stylesheet" href="{{ secure_asset('css/create-private.css') }}">
    <div class="container">
        <h1>Schedule Private Event</h1>
        <div class="col-xs-12">

                {{Form::open(['route' => 'events.schedulePrivateEvent', 'method' => 'post'])}}
                    
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
                    
                    <div class="row">
                    {{Form::submit('schedule')}}
                    </div>
                
                {{Form::close()}}
                
        </div>
    </div>
@endsection