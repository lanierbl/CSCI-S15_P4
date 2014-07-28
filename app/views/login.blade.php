@extends('_master')

@section('title')
Sign-up
@stop

@section('head')

@stop

@section('content')

    <!-- /app/views/login.blade.php -->

    <h1>Log in</h1>

    {{ Form::open(array('url' => '/login')) }}

        Username<br>
        {{ Form::text('username') }}<br><br>

        Password:<br>
        {{ Form::password('password') }}<br><br>

        {{ Form::submit('Submit') }}

    {{ Form::close() }}

@stop