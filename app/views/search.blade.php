@extends('_master')

@section('title')
Search
@stop

@section('head')

@stop

@section('content')

<!-- /app/views/login.blade.php -->

    <h1>Search</h1>

    {{ Form::open(array('url' => '/search')) }}

        Style<br>
        {{ Form::text('username') }}<br><br>

        Password:<br>
        {{ Form::password('password') }}<br><br>

        Garage:
        {{ Form::checkbox('garage', 'T') }}<br><br>

        Pool:
        {{ Form::checkbox('pool', 'T') }}<br><br>


        $home->style = 'Condo';

        $home->addr_city = 'Boston';
        $home->addr_state = 'MA';

        $home->num_bed = 2;
        $home->num_bath = 1;
        $home->num_halfbath = 1;
        $home->sqrfoot = 1850;
        $home->lot_sqrfoot = 0;
        $home->park_spaces = 0;



        {{ Form::submit('Submit') }}

    {{ Form::close() }}

@stop