@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-4">
                <h3 class="panel-title">Group Name: {{ $group->name }}</h3>
                    @foreach($members as $member)
                        <p>{{$member->name}}</p>
                    @endforeach
                </div>
                    {{ $group->name }}
                </h1>
                <div class="col-xs-offset-3 col-xs-6">
                    <a href="{{route('makegroup.edit', ['id' => $group->id])}}" class="btn btn-block" id="edit">Edit</a>
                </div>
                
                <div class="col-xs-offset-3 col-xs-6" style="margin-top: 10px;">
                    @foreach($members as $member)
                        <p><img class="img-circle" src="{{$member->getImageUrl()}}" alt="" style="width:50px;"> &nbsp;{{$member->name}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection