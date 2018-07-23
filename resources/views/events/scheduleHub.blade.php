@extends('layouts.app')

@section('head-plus')
    <link href="{{asset('css/commons/generals.css')}}">
@endsection

@section('content')
<div class="container">
    @include('commons.messages')
    
    <div class="col-xs-12 col-md-offset-2 col-md-4">
        <a href="{{ route('events.showScheduleInPrivate') }}?year={{ $year }}&month={{ $month }}" class="btn btn-default btn-block">Private Event</a>
    </div>
    <div class="col-xs-12 col-md-4">
        <a href="{{ route('events.showScheduleWithGroup') }}?year={{ $year }}&month={{ $month }}" class="btn btn-default btn-block">Group Event</a>
    </div>
</div>
@endsection