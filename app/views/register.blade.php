@extends('_master')

@section('title')
Registration
@stop

@section('head')

@stop

@section('content')

    <!-- /app/views/register.blade.php -->

    <h1>Register for Site</h1>

    {{ Form::open(array('url' => '/register')) }}

        Email<br>
        {{ Form::text('email') }}<br><br>

        Password:<br>
        {{ Form::password('password') }}<br><br>

        {{ Form::submit('Submit') }}

    {{ Form::close() }}

@stop