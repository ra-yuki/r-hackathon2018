@if (Auth::id() != $user->id)
    @if (Auth::user()->is_friend($user->id))

    {!! Form::open(['route' => ['unfriend', $user->id], 'method' => 'delete']) !!}
        <!--{!! Form::submit('Unfriend', ['class' => "btn btn-danger"]) !!}-->
       <button class="btn btn-default" type="submit"> <span class="glyphicon glyphicon-minus"></span> Unfriend</button>
        
    {!! Form::close() !!}
 
    @else
 
    {!! Form::open(['route' => ['add.get', $user->id], 'method' => 'get']) !!}
        <!--{!! Form::submit('Add', ['class' => "btn btn-success btn-xs"]) !!}-->
        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-plus"></span> Add</button>
     
    {!! Form::close() !!}
   
    @endif
@endif