@extends('layouts.app')

@section('head-plus')
    <link rel="stylesheet" href="{{secure_asset('css/commons/buttons.css')}}">    
@endsection


@section('content')
    <div class="container">
        <div class="row">
                <p class="text-center "><img style="width:250px;" src="{{$group->getImageUrl()}}" alt=""></p>
                    <div class="text-center"><h1>{{ $group->name }}</h1></div>
                </h1>
                
                <div class="col-xs-offset-5 col-xs-2">
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