@extends('layouts.app')

@section('content')
{!! Form::open(['route' => 'makegroup.store', 'method' => 'post']) !!}
      <dl>
        <dt>Group name</dt>
        <dd><input type="text" name="name" placeholder="Group name"></dd> 
    </dl>
    @foreach($friends as $friend)
        <input type="checkbox" name="friends[]" value={{$friend->id}}> {{$friend->name}} <br> 
    @endforeach
    <input type="submit" name="Create">
{!! Form::close() !!}

@endsection