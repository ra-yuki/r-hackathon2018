@extends('layouts.app')

@section('content')
    <h1>Schdulable Dates</h1>
    <h2>Most joinable num '{{$max}}' ppl</h2>
    <h2>Need at least '{{$threshold}}' ppl to make it happen</h2>
    {{ dd($result) }}
@endsection