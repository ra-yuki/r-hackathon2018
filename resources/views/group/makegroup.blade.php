@extends('layouts.app')

@section('head-plus')
    <link href="{{ asset('css/commons/buttons.css') }}">
@endsection

@section('content')

    <div class="container">
        <h1 class="text-center">Make Group</h1>
        <div class="col-xs-12 col-md-offset-4 col-md-4">
            {!! Form::open(['route' => 'makegroup.store', 'method' => 'post']) !!}
                <div class="row">
                    <h4>Group Name</h4>
                    
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Group name" class="form-control">
                    </div>
                </div>
                
                <div class="row">
                    <h4>Choose Members</h4>
                    @foreach($friends as $friend)
                        <input id="friend{{$friend->id}}" type="checkbox" name="friends[]" value={{$friend->id}}>  
                        <label for="friend{{$friend->id}}"><img class="img-circle" src="{{$friend->imageUrl}}" alt="" style="width:50px;"></label>
                        &nbsp; {{$friend->name}}<br><br>
                    @endforeach
                </div>
               
               <br>
               <p class="text-center"><button class="btn btn-default">Create</button></p>
            {!! Form::close() !!}
        </div>
    </div>

@endsection