@extends('layout')
@section('content')
    <h1>Course Details (ID: {{ $id }})</h1>
        
    @foreach($courses[$id] as $course)
        <p>{{ $course }}</p>
    @endforeach

    <br>
    <a href="/">Click Here</a>
@endsection
