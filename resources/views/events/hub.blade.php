@extends('layouts.app')

@section('head-plus')

@endsection

@section('content')
<div class="container">
    <h1 class="text-center">{{$events[0]->title}}</h1>
    <h3 class="text-center">TIME: {{$events[0]->timeFrom}} - {{$events[0]->timeTo}}</h3>
    <h3 class="text-center">DESCRIPTION: {{$events[0]->description}}</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col"></th>
                @foreach($events as $e)
                    <?php $date = (new \DateTime($e->dateTimeFromSelf))->format('y/m/d') ?>
                    <th scope="col">{{$date}}</th>
                @endforeach
            </tr>
        </thead>
            @foreach($users as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    {{-- @foreach($events as $e)
                            @if($availableDates[$u->id]['from'] == $eventsFromToTimestamp[$e->dateTimeFromSelf])
                                <td>O</td>
                            @else
                                <td>X</td>
                            @endif
                    @endforeach --}}
                </tr>
            @endforeach
        <tbody>
        </tbody>
    </table>
</div>

{{dd($availableDates)}}

@endsection