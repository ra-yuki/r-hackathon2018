@extends('layouts.app')


@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <img class="media-object img-rounded img-responsive" src="moo.jpg" alt="icon"> 
                </div>
                <div class="panel-body">
                    <p>change photo</p>
                    <h3 class="panel-title">{{$user->name}}</h3>
                </div>
            </div>
            
        </aside>
        
            
            
           

    </div>
@endsection