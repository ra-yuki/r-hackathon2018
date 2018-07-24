@extends('layouts.app')

@section('head-plus')
    <link rel="stylesheet" href="{{ asset('css/commons/generals.css') }}">
@endsection

@section('content')
<div class="container">
    @include('commons.messages')
    <!-- title -->
    <h1 class="text-center">{{$events[0]->title}}</h1>
    
    <!-- description -->
    <h4 class="text-center">{{$events[0]->description}}</h4>
    <!-- group info -->
    <h4 class="text-center"><img class="img-circle" src="{{$group->getImageUrl()}}" alt="" style="width:50px;">&nbsp;{{ $group->name }}</h4>
    <!-- time -->
    <h4 class="text-center">{{$events[0]->timeFrom}} - {{$events[0]->timeTo}}</h4>
    
    
    <!-- availability table -->
    <h3>Best Available Dates <small>Choose the day you like to make happen!</small></h3>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                @foreach($events as $e)
                    <th scope="col">
                        {{ preg_replace(
                            "/([ 0-9\/]*)([a-zA-Z]{3}).*/",
                            "$1($2)", 
                            (new \DateTime($e->dateTimeFromSelf))->format('y/m/d l')
                        ) }}
                        {!! link_to_route('events.fix', 'Schedule here!', ['id'=>$e->id],['class'=>'btn','id'=>'here']) !!}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr>
                    <td>
                        <img class="img-circle" src="{{$u->getImageUrl()}}" alt="" style="width:25px;">
                        {{$u->name}}
                    </td>
                    @foreach($events as $e)
                        @if(in_array($u->id, $e->availables))
                            <td>O</td>
                        @else
                            <td>X</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- render poll -->
    <div id="poll" class="col-xs-12 col-md-offset-3 col-md-6">
        <!-- poll title -->
        @if(count($polls) > 0)
            <h3 class="text-center">Polls</h3>
        @endif
        <!-- poll main -->
        @foreach($polls as $p)
            <h4 class="text-center">{{ $p->title }}</h4>
            @foreach($p->links as $l)
                <div class="col-xs-12">
                    <p>
                        @if(\Auth::user()->isVoted($l->id))
                            {{ Form::open( ['route' => ['user.unvote', $l->id], 'method' => 'delete', 'class' => 'm-0 p-0'] ) }}
                                <a href="{{ $l->url }}" target="_blank">{{ $l->title }}</a> |
                                <button class="btn btn-danger">Unvote</button>
                            {{ Form::close() }}
                        @elseif(\Auth::user()->isVotedAny($l->id))
                            <a href="{{ $l->url }}" target="_blank">{{ $l->title }}</a> |
                            <br>
                        @else
                            <a href="{{ $l->url }}" target="_blank">{{ $l->title }}</a> |
                            <a class="btn btn-primary" href="{{ route('user.vote', ['id' => $l->id]) }}">Vote</a>
                            <br>
                        @endif
                        @foreach($l->users as $u)
                            #[{{ $u->name }}]
                        @endforeach
                    </p>
                </div>
            @endforeach
        @endforeach
    </div>
    
    <!-- buttons -->
    <div class="col-xs-12">
        <div class="col-xs-offset-2 col-xs-8 col-md-offset-2 col-md-4">
            <a href="{{ route('events.showRescheduleWithGroup', ['id' => $events[0]->id]) }}" class="btn btn-block" id="res">Reschedule</a>
        </div>
        <div class="col-xs-offset-2 col-xs-8 col-md-offset-0 col-md-4">
            {{ Form::open( ['route' => ['events.destroy', $events[0]->id], 'method' => 'delete', 'style' => 'display:inline;'] ) }}
                <button class="btn btn-block" id="dn">Delete</a>
            {{ Form::close() }}
        </div>
    </div>
</div>


@endsection