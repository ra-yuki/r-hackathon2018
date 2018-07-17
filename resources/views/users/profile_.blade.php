@extends('layouts.app')


@section('content')
    <div id="top-wrapper" class="container">
        <div class="col-xs-12">
            @if(session('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div id="top-main" class="col-xs-12">
            <div class="row">
                <div id="top-image-wrapper" class="col-xs-12">
                    <p class="text-center"><img src="{{$imageUrl}}" alt="{{$imageUrl}}"></p>
                    <form action="{{route('profile.uploadImage')}}" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control-file">
                        </div>
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input class="btn btn-primary" type="submit" value="Upload" name="submit">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="top-user-info-wrapper" class="col-xs-12">
                    <h1 class="text-center">{{$user->name}}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection