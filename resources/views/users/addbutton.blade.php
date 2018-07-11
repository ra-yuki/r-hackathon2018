@if (Auth::id() != $user->id)
    @if (Auth::user()->is_friend($user->id))

    {!! Form::open(['route' => ['unfriend', $user->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unfriend', ['class' => "btn btn-danger"]) !!}
    {!! Form::close() !!}
 
    @else
 
    {!! Form::open(['route' => ['add.get', $user->id], 'method' => 'get']) !!}
        {!! Form::submit('Add', ['class' => "btn btn-success btn-xs"]) !!}
    {!! Form::close() !!}
   
    @endif
@endif