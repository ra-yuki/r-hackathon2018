@extends('layouts.app')

@section('head-plus')
    <link rel="stylesheet" href="{{ asset('css/commons/generals.css') }}">
@endsection

@section('content')
<div class="container">
    @include('commons.messages')
    <h1 class="text-center">{{$events[0]->title}}</h1>
    <h3 class="text-center">TIME: {{$events[0]->timeFrom}} - {{$events[0]->timeTo}}</h3>
    <h3 class="text-center">DESCRIPTION: {{$events[0]->description}}</h3>
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
                        {{-- {!! link_to_route('events.show', 'Detail', ['id'=>$e->id],['class'=>'btn btn-primary']) !!} --}}
                        {!! link_to_route('events.fix', 'Fix', ['id'=>$e->id],['class'=>'btn btn-danger']) !!}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr>
                    <td>{{$u->name}}</td>
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
</div>


@endsection