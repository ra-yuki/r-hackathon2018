@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <aside class="col-xs-4">
                <h3 class="panel-title">Group Name: {{ $group->name }}</h3>
                    @foreach($members as $member)
                        <p>{{$member->name}}</p>
                    @endforeach
                    {{-- <div class="panel-body"> 
                       @include('users.friends', ['friends' => $group])
                    </div> --}}
                </div>
            </aside>
        </div>
    </div>
@endsection