@extends('_master')

@section('title')
Registration
@stop

@section('head')

@stop

@section('body')

    <!-- /app/views/register.blade.php -->

    <h1>Register for Site</h1>

    {{ Form::open(array('url' => '/register')) }}

        First Name<br>
        {{ Form::text('first_name') }}<br><br>

        Last Name<br>
        {{ Form::text('last_name') }}<br><br>

        Email<br>
        {{ Form::text('email') }}<br><br>

        Username<br>
        {{ Form::text('username') }}<br><br>

        Password:<br>
        {{ Form::password('password') }}<br><br>

        {{ Form::submit('Submit') }}

    {{ Form::close() }}

@stop

@section('scripts')
@stop