@extends('layouts.app')

@section('head-plus')
    <link rel="stylesheet" href="{{ secure_asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/commons/buttons.css') }}">
@endsection

@section('content')
 <div class="navbar">
   <a class="navbar-brand" href="/" id="popcorn">POPCON</a>
 </div>
<div id="wrapper" class="container">
    <div class="kakomi-te1">

    <div class="row justify-content-center">
        <h1 id="login-txt" class="text-center">{{ __('login') }}</h1>
        <br>
        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <div id="form-name" class="row">
                <div class="form-group col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4" id="user">
                    <input placeholder="username" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
        
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                                    
                </div>
            </div>
            <div id="form-passwd" class="row">
                <div class="form-group col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4" id="pass">
                    <input placeholder="password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <p></p>
                    <div class="form-group row mb-0">
                        <div class="col-xs-offset-9 col-md-offset-10">
                            <button type="submit" class="btn">
                                {{ __('login') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="not-a-member" class="text-center">
            <a href="{{route('signup.get')}}">Not a member?</a>
        </div>
    </div>
   </div>
</div>
@endsection