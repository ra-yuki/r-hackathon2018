<!--グループ参加用-->

@if (Auth::id() != $user->id)-->
    @if (Auth::user()->is_group($user->id))

    {!! Form::open(['route' => ['makegroup', $user->id], 'method' => 'destroy']) !!}
        {!! Form::submit('Leave', ['class' => "btn btn-danger"]) !!}
    {!! Form::close() !!}
 
     @else
 
    {!! Form::open(['route' => ['makegroup', $user->id], 'method' => 'store']) !!}
        {!! Form::submit('Make group', ['class' => "btn btn-danger btn-xs"]) !!}
    {!! Form::close() !!}
   
    @endif
@endif