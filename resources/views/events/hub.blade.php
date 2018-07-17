@extends('layouts.app')

@section('head-plus')

@endsection

@section('content')
<div class="container">
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
                        {!! link_to_route('events.show', 'Detail', ['id'=>$e->id],['class'=>'btn btn-primary']) !!}
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
</div>


@endsection