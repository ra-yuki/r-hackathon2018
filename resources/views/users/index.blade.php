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
    <div class="user-profile">
        <div class="name text-center">
            <img src={{ secure_asset('images/ariel.png') }}>
            <img src={{ secure_asset('images/calender.png') }}>
        </div>
        <div class="status text-center">
        </div>
    </div>
 
@endsection