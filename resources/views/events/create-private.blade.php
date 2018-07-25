@extends('layouts.app')

@section('head-plus')
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    <link href="{{ asset('css/commons/buttons.css') }}" rel="stylesheet">
@endsection

@section('content')
   <div class="container" id="all">
       @include('commons.messages')
        <h1>Schedule Private Event</h1>
        <!--<p>&nbsp&nbspmake a personal event</p>-->
        <br>
        
        <div class="col-xs-12" >
                {{Form::open(['route' => 'events.scheduleInPrivate', 'method' => 'post'])}}
                    <div class="row">
                        {{Form::label('title')}}
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
                        <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2 waku">
                           {{Form::text('title',old('title'),['class' => 'form-control','placeholder' => 'ex.) Drive'])}}
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('Memo')}}
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
                        <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 waku">
                           {{Form::text('description',old('description'),['class' => 'form-control','placeholder' => 'ex.) Go to Atami with my family'])}}
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('date start')}}
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
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            @if($date != null)
                                {{Form::date('dateFrom',$date,['class' => 'form-control'])}}
                            @else
                                {{Form::date('dateFrom',old('dateFrom'),['class' => 'form-control'])}}
                            @endif
                        </div>
                    </div>
                    
                    <p></p>
                    <div class="row">
                        {{Form::label('date end')}}
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
                        <div class="col-xs-7 col-sm-3 col-md-2 col-lg-2 waku">
                            @if($date != null)
                                {{Form::date('dateTo',$date,['class' => 'form-control'])}}
                            @else
                                {{Form::date('dateTo',old('dateTo'),['class' => 'form-control'])}}
                            @endif
                        </div>
                    </div>
                
                    <p></p>
                    <div class="row">
                        {{Form::label('time start')}}
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
                        <div class="input-group clockpicker col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                            <input type="time" class="form-control" value="{{old('timeFrom')}}" name="timeFrom">
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
                        <div class="input-group clockpicker  col-xs-5 col-sm-3 col-md-2 col-lg-2 wakuwaku" data-placement="right" data-align="top" data-autoclose="true">
                            <input type="time" class="form-control" value="{{old('timeTo')}}" name="timeTo">
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
                    <button class="btn" id="cre">Add Plan</button>
                    </div>
                {{Form::close()}}
           
        </div>
    </div>
   
@endsection