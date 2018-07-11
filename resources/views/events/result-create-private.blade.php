@extends('layouts.app')

@section('content')
    <h1>Result</h1>
    <h2>{{$result->title}}</h2>
    <ul>
        <li>from: {{$result->dateTimeFromSelf}}</li>
        <li>to: {{$result->dateTimeToSelf}}</li>
    </ul>
@endsection