@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Schedule Private Event</h1>
        <div class="col-xs-12">
                {{Form::open(['route' => 'events.schedulePrivateEvent', 'method' => 'post'])}}
                    {{Form::label('title')}}
                    {{Form::text('title')}}
                    {{Form::label('date start')}}
                    {{Form::date('dateFrom')}}
                    {{Form::label('date end')}}
                    {{Form::date('dateTo')}}
                    {{Form::label('time start')}}
                    {{Form::time('timeFrom')}}
                    {{Form::label('time end')}}
                    {{Form::time('timeTo')}}
        
                    {{Form::submit('schedule')}}
                {{Form::close()}}
        </div>
    </div>
@endsection