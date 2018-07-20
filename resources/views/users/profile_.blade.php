@extends('layouts.app')

@section('head-plus')
    <link rel="stylesheet" href="{{secure_asset('css/commons/buttons.css')}}">
@endsection)

@section('content')
    <div id="top-wrapper" class="container">
        @include('commons.messages')
        <div id="top-main" class="col-xs-12">
            <div class="row">
                <div id="top-image-wrapper" class="col-xs-12">
                    <p class="text-center"><img class="img-circle" src="{{$imageUrl}}" alt="{{$imageUrl}}" style="width:250px;"></p>
                    <!-- upload image form -->
                    <form action="{{route('profile.uploadImage')}}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="top-user-info-wrapper" class="col-xs-12">
                                    <h1 class="text-center">{{$user->name}}</h1>
                                </div>
                            </div>
                                
                            <div class="col-xs-offset-4 col-xs-4" >
                                
                                <div class="col-xs-8">
                                     <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                               
                                <div class="col-xs-4">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            
            <!-- logout button -->
            <div class="row">
                <p class="text-center">
                    <br>
                    <a href="{{route('logout.get')}}" class="btn btn-danger">Logout</a>
                </p>
            </div>
        </div>
    </div>
@endsection