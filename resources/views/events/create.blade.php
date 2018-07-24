@extends('layouts.app')

@section('head-plus')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    <link href="{{ asset('css/commons/buttons.css') }}" rel="stylesheet">

    <!--<script type="text/javascript" src="{{ asset('js/inputsPoll.js') }}"></script>-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
@endsection

@section('content')
    <div class="container" id="all">
        <h1 class="wakuwakuwaku">Schedule Group Event</h1><br>
        <div class="col-xs-12" >
            <?php $exists = isset($event) ?>
            
            <!-- Scheduling Form -->
            @if(!$exists)
                {{Form::open(['route' => 'events.scheduleWithGroup', 'method' => 'post'])}}
                    <div class="row">
                        {{Form::label('title')}}
                        <div class="hidden_box">
                            <label for="label5"><span class="glyphicon glyphicon-info-sign"></span></label>
                            <input type="checkbox" id="label5"/>
                            <div class="hidden_show">
                              <!--非表示ここから-->     
                              	<p>&nbsp&nbspselect available date for the event</p>
                              <!--ここまで-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2 waku">
                           {{Form::text('title',null,['class' => 'form-control','placeholder' => 'ex.) Drive'])}}
                        </div>
                    </div>
                    <p></p>
                    
                    <div class="row">
                        {{Form::label('memo')}}
                        <div class="hidden_box">
                            <label for="label6"><span class="glyphicon glyphicon-info-sign"></span></label>
                            <input type="checkbox" id="label6"/>
                            <div class="hidden_show">
                              <!--非表示ここから-->     
                              	<p>&nbsp&nbspselect available date for the event</p>
                              <!--ここまで-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 waku">
                           {{Form::text('description',null,['class' => 'form-control','placeholder' => 'ex.) Shall we go to Atami?'])}}
                        </div>
                    </div>
                    <p></p>
                   
                    <div class="row">
                        {{Form::label('Group Select') }}
                        <div class="hidden_box">
                            <label for="label7"><span class="glyphicon glyphicon-info-sign"></span></label>
                            <input type="checkbox" id="label7"/>
                            <div class="hidden_show">
                              <!--非表示ここから-->     
                              	<p>&nbsp&nbspselect available date for the event</p>
                              <!--ここまで-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-3 col-md-2 col-lg-2 waku">
                        <select name="groupId" class="selectpicker" data-live-search="true" title="select group">
                            @foreach($groups as $g)
                                <?php if(isset($_GET['groupId']) && $_GET['groupId'] == $g->id){ ?>
                                    <option value="{{$g->id}}" selected>{{$g->name}}</option>
                                <?php }else{ ?>
                                    <option value="{{$g->id}}">{{$g->name}}</option>
                                <?php } ?>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('date from')}}
                            <div class="hidden_box">
                                <label for="label1"><span class="glyphicon glyphicon-info-sign"></span></label>
                                <input type="checkbox" id="label1"/>
                                <div class="hidden_show">
                                  <!--非表示ここから-->     
                                  	<p>&nbsp&nbspselect available date for the event</p>
                                  <!--ここまで-->
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            {{Form::date('dateFrom',null,['class' => 'form-control'])}}
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('date to')}}
                        <div class="hidden_box">
                            <label for="label2"><span class="glyphicon glyphicon-info-sign"></span></label>
                            <input type="checkbox" id="label2"/>
                            <div class="hidden_show">
                              <!--非表示ここから-->     
                              	<p>&nbsp&nbspselect available date for the event</p>
                              <!--ここまで-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            {{Form::date('dateTo',null,['class' => 'form-control'])}}
                        </div>
                    </div>
                
                    <p></p>
                    <div class="row">
                        {{Form::label('time start')}}
                        <div class="hidden_box">
                            <label for="label3"><span class="glyphicon glyphicon-info-sign"></span></label>
                            <input type="checkbox" id="label3"/>
                            <div class="hidden_show">
                              <!--非表示ここから-->     
                              	<p>&nbsp&nbspselect available date for the event</p>
                              <!--ここまで-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="input-group clockpicker col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                            <input type="time" class="form-control" value="00:00" name="timeFrom">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                        </div>
                        <script type="text/javascript">
                            $('.clockpicker').clockpicker();
                        </script>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('time end')}}
                        <div class="hidden_box">
                            <label for="label4"><span class="glyphicon glyphicon-info-sign"></span></label>
                            <input type="checkbox" id="label4"/>
                            <div class="hidden_show">
                              <!--非表示ここから-->     
                              	<p>&nbsp&nbspselect available date for the event</p>
                              <!--ここまで-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="input-group clockpicker  col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                            <input type="time" class="form-control" value="00:00" name="timeTo">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                        </div>
                        <script type="text/javascript">
                            $('.clockpicker').clockpicker();
                        </script>
                    </div>
                    
                    <!-- input field for polls -->
                    <!--<div class="row">-->
                    <!--    <h3>Polls</h3>-->
                    <!--    <a href="#" onclick="displayPolls(1)" class="btn btn-default">+</a> | <a href="#" onclick="displayPolls(-1)" class="btn btn-default">-</a>-->
                    <!--    <div id="inputs-poll" class="row">-->
                            <!-- heavily on inputsPoll.js -->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <p></p>
                    <div class="row col-xs-2 col-xs-offset-3">
                        <button class="btn" id="sc">Create</button>
                    </div>
                {{Form::close()}}
            
            <!-- Rescheduling Form -->
            @else
                {{Form::open(['route' => ['events.rescheduleWithGroup', $event->id], 'method' => 'post'])}}
                    <div class="row">
                        {{Form::label('title')}}
                    </div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2 waku">
                           {{Form::text('title',$event->title,['class' => 'form-control'])}}
                        </div>
                    </div>
                    <p></p>
                   
                    <div class="row">
                        {{Form::label('Group Select') }}
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-3 col-md-2 col-lg-2 waku">
                        <select name="groupId" class="selectpicker" data-live-search="true" title="select group">
                            @foreach($groups as $g)
                                @if($g->id == $groupSelected->id)
                                    <option value="{{$g->id}}" selected>
                                @else
                                    <option value="{{$g->id}}">
                                @endif
                                        {{$g->name}}
                                    </option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        {{Form::label('description')}}
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 waku">
                           {{Form::text('description', $event->description, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('date from')}}
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            {{Form::date('dateFrom',$event->dateFrom,['class' => 'form-control'])}}
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        
                            {{Form::label('date to')}}
                       
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            {{Form::date('dateTo',$event->dateTo,['class' => 'form-control'])}}
                        </div>
                    </div>
                
                    <p></p>
                    <div class="row">
                        {{Form::label('time start')}}
                    </div>
                    <div class="row">
                        
                        <div class="input-group clockpicker col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                            <input type="time" class="form-control" value="{{$event->timeFrom}}" name="timeFrom">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                        </div>
                        <script type="text/javascript">
                            $('.clockpicker').clockpicker();
                        </script>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('time end')}}
                    </div>
                    <div class="row">
                        
                        <div class="input-group clockpicker  col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                            <input type="time" class="form-control" value="{{$event->timeTo}}" name="timeTo">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                        </div>
                        <script type="text/javascript">
                            $('.clockpicker').clockpicker();
                        </script>
                    </div>
                    
                    <p></p>
                        <div class="row col-xs-2 col-xs-offset-3">
                        <button class="btn" id="">Reschedule</button>
                    </div>
                {{Form::close()}}
            @endif
        </div>
    </div>
@endsection