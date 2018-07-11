@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Schedule Group Event</h1>
        <div class="col-xs-12">
                {{Form::open(['route' => 'events.scheduleGroupEvent', 'method' => 'post'])}}
                    {{Form::label('title')}}
                    {{Form::text('title')}}
                    {{Form::label('group ID')}}
                    {{Form::number('groupId')}}
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
        </div>
    </div>
@endsection