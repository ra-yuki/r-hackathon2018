@extends('layouts.app')

@section('head-plus')

    <link href="{{ asset('css/commons/buttons.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        @include('commons.messages')
        <h1 class="text-center">Edit {{$group->name}}</h1>
        
        <div class="col-xs-12 col-md-offset-4 col-md-4">
            <h2>Image</h2>
            <div id="border-wrapper" class="col-xs-12" style="border: 1px solid #cacaca;">
                <div id="basic-info-inputs" class="col-xs-12" style="padding:0 20px 20px;">
                    {!! Form::open(['route' => ['groups.uploadImage', $group->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <h3 class="text-center">
                                <img src="{{ $group->getImageUrl() }}" style="width:70%;">
                            </h3>
                            
                            <div class="form-group">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                            
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-offset-2 col-xs-8">
                                    <button class="btn btn-block" id="up">Upload</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-md-offset-4 col-md-4">
            <h2>Basic Info</h2>
            <div id="border-wrapper" class="col-xs-12" style="border: 1px solid #cacaca;">
                <div id="basic-info-inputs" class="col-xs-12" style="padding:0 20px 20px;">
                    {!! Form::open(['route' => ['makegroup.update', $group->id], 'method' => 'put']) !!}
                        <div class="row">
                            <h3>Change Group Name</h3>
                            
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Group name" class="form-control" value="{{ $group->name }}">
                            </div>
                        </div>
                        
                        <div class="row">
                            <h3>Delete Members</h3>
                            @foreach($members as $member)
                                <input id="member{{$member->id}}" type="checkbox" name="members[]" value={{$member->id}}>  
                                <label for="member{{$member->id}}"><img class="img-circle" src="{{$member->getImageUrl()}}" alt="" style="width:50px;"></label>
                                &nbsp; {{$member->name}}<br><br>
                            @endforeach
                        </div>
                        
                        <div class="row">
                            <h3>Add Members</h3>
                            @if(count($friends) > 0)
                                @foreach($friends as $friend)
                                    <input id="friend{{$friend->id}}" type="checkbox" name="friends[]" value={{$friend->id}}>  
                                    <label for="friend{{$friend->id}}"><img class="img-circle" src="{{$friend->getImageUrl()}}" alt="" style="width:50px;"></label>
                                    &nbsp; {{$friend->name}}<br><br>
                                @endforeach
                            @else
                                <p><i>No friends to add</i> (<a href="{{ route('user.index') }}" target="_blank">Find new friends?</a>)</p>
                            @endif
                        </div>
                       
                       <br>
                       
                       <div class="row">
                           <div class="col-xs-offset-2 col-xs-8">
                               <button class="btn btn-block" id="upd">Update</button>
                           </div>
                       </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-md-offset-4 col-md-4">
            <br><h2>Danger Zone</h2>
            <div id="border-wrapper" class="col-xs-12" style="border: 1px solid #ca5555;">
                <div id="basic-info-inputs" class="col-xs-12" style="padding: 0 20px 20px;">
                    {!! Form::open(['route' => ['makegroup.destroy', $group->id], 'method' => 'delete']) !!}
                        <div class="row">   
                            <h3>Leave '{{ $group->name }}'</h3>
                            <p>Once you leave this group, all the associated Group Events will be unlisted on your calendar.</p>
                            <div class="col-xs-offset-2 col-xs-8" style="margin-bottom: 20px;">
                                <a href="{{route('makegroup.leave', ['id' => $group->id])}}" class="btn btn-block" id="lg">Leave Group</a>
                            </div>
                            
                            <br>
                            <h3>Delete '{{ $group->name }}'</h3>
                            <p>Once you delete this group, all the associated Group Events will be removed. This action is permanent. No turning back.</p>
                            <div class="col-xs-offset-2 col-xs-8">
                                <button class="btn btn-block" id="dg">Delete Group</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection