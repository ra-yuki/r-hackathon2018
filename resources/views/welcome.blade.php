@extends('layouts.app')

@section('head-plus')
    <link rel="stylesheet" href="{{secure_asset('css/commons/buttons.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/welcome.css')}}">
@endsection

@section('content')
<div id="wrapper-container">
    <div id="top-cover" class="col-xs-12 bg-red">
        <h2 class="text-center">POPCON</h2>
        <p class="text-center">_________</p>
        <h1 class="text-center">Adjust Your Schedule, Quicker Than Ever</h1>
        <p class="text-center">
            <a class="col-xs-offset-4 col-xs-2">Login</a>
            <a class="col-xs-2">Signup</a>
        </p>
    </div>
    <div id="top-welcome" class="col-xs-12 bg-green">
        <div class="col-xs-offset-3 col-xs-6">
            <h2 class="text-center">Welcome</h2>
            <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing</p>
            
        </div>
    </div>
    <div id="middle-slide" class="col-xs-12 bg-blue">
        <h1 class="text-center">Slides are supposed to go here</h1>
    </div>
    <div id="bottom-lets-start" class="col-xs-12 bg-red">
        <h1 class="text-center">Let's get started!</h1>
        <p class="text-center">
            <a>Signup</a>
        </p>
    </div>
    
    @include('commons.footer')
</div>
@endsection

