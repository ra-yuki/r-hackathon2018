@extends('layouts.app')

@section('head-plus')
    <link href="{{asset('css/commons/generals.css')}}">
@endsection

@section('content')
<link href="{{ asset('css/commons/buttons.css') }}" rel="stylesheet">
<div class="container">
    @include('commons.messages')
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <h1>{{$event->title}}</h1><br>
        <div id="description" class="row">
            <div id="clock" class="col-xs-1">
                <h2 style="margin-top:10px;"><span class="glyphicon glyphicon-tags"></span></h2>
            </div>
            <div>
                <h4> {{$event->description}}</h4><br>
            </div> 
        </div>
        
        <div id="date-time" class="row">
            <div id="clock" class="col-xs-1">
                <h2><span class="glyphicon glyphicon-calendar"></span></h2>
            </div>
            <div id="date-from" class="col-xs-2" style="padding: 0px;">
                <?php
                    $dates = explode(' ', $event->dateTimeFromSelf);
                    $dates[1] = explode(':', $dates[1])[0] . ':'. explode(':', $dates[1])[1];
                ?>
                
                <!--<h4>2018-09-07</h4>-->
                <!--<h5>09:00</h5>-->
                <h4>{{$dates[0]}}</h4>
                <h5>{{$dates[1]}}</h5>
            </div>
            <div id="from-to" class="col-xs-1" style="padding: 0px;">
                <h2>ー</h2>
            </div>
            <div id="date-to" class="col-xs-2" style="padding: 0px;">
                <?php
                    $dates = explode(' ', $event->dateTimeToSelf);
                    $dates[1] = explode(':', $dates[1])[0] . ':'. explode(':', $dates[1])[1];
                ?>
                
                
                <h4>{{$dates[0]}}</h4>
                <h5>{{$dates[1]}}</h5>
                {{-- {{$event->dateTimeToSelf}} --}}
            </div>
        </div>
        
        @if(preg_match("/@[0-9]*/",$event->groups[0]->name, $output_array)==false)
            <div id="group-member" class="row">
                 <div class="col-xs-1" >
                    <h2><span class="glyphicon glyphicon-user"></span></h2>
                 </div>
                 <div class="col-xs-2" style="padding: 0px;">
                     <h3>
                         <a href="{{route('groups.show',['id'=>$event->groups[0]->id])}}">
                             <img class="img-circle" src="{{$group->getImageUrl()}}" alt="" style="width:50px;">
                             &nbsp;{{$event->groups[0]->name}}
                         </a>
                    </h3>
                </div>
            </div>
        @endif
        
        <!-- Poll info -->
        <!--<div id="URL" class="row" >-->
        <!--   <div class="col-xs-1" >-->
        <!--       <h2><span class="glyphicon glyphicon-list-alt"></span></h2>-->
        <!--   </div>-->
        <!--   <div class="col-xs-2" style="padding: 0px;">-->
        <!--       <p>投票名前</p> -->
        <!--       <p>候補1</p>-->
        <!--       <p>候補2</p>-->
        <!--       <p>候補3</p>-->
        <!--   </div>-->
        <!--</div>-->
        
        @if($event->fixed) {!! link_to_route('events.edit', 'Edit', ['id'=>$event->id],['class'=>'btn','id'=>'edit']) !!}
        @else {!! link_to_route('events.showRescheduleWithGroup', 'Reschedule', ['id'=>$event->id],['class'=>'btn btn-primary']) !!}
        @endif
        {!! Form::open(['route' => ['events.destroy', $event->id], 'method' => 'delete']) !!}
          <br>  <button class="btn" id="danger">Delete</button>
        {!! Form::close() !!}
    
    </div>
</div>
@endsection