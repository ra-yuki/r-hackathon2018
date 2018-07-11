@extends('layouts.app')



@section('content')

<div id="wrapper-top" class="container">
    <div id="tableWrapper-top" class="col-xs-12">
        @include('commons.calendar', [
            'year' => $year,
            'month' => $month,
            'days' => $days,
        ])
    </div>
</div>

{{-- @include('group.makegroup_button') --}}
@endsection