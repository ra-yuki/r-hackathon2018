@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Group Name: {{ $group->name }}</h3>
                </div>
                <div class="panel-body">
                    @foreach($members as $member)
                        <p>{{$member->name}}</p>
                    @endforeach
                </div>
                {{-- <div class="panel-body"> 
                   @include('users.friends', ['friends' => $group])
                </div> --}}
            </div>
        </aside>
       
        </div>
    </div>
@endsection