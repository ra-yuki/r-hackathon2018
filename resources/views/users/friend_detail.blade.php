@extends('layouts.app')


@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$friend->name}}</h3>
                </div>
                <div class="panel-body">
                    {{-- <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="icon"> --}}
                </div>
            </div>
            
        </aside>
        
            
            
           

    </div>
@endsection