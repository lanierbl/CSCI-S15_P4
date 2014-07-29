@extends('_master')

@section('title')
Search
@stop

@section('head')
    {{ HTML::script('scripts/search.js') }}
@stop

@section('content')

<!-- /app/views/login.blade.php -->

    <h1>Search</h1>

    {{ Form::open(array('action' => 'P4Logic@search')) }}

        State:
        <select id="state" name="state">
        </select>
        <br><br>
        City:
        <select id="city" name="city">
            <option>Select State First</option>
        </select>
        <br><br>
        Style:
        <select id="style" name="style">
        </select>
        <br><br>

        Bedrooms:
        {{ Form::selectRange('num_bed', 1, 4) }}<br><br>

        Bathrooms:
        {{ Form::selectRange('num_bath', 1, 3) }}<br><br>

        Half Bathrooms:
        {{ Form::selectRange('num_halfbath', 0, 2) }}<br><br>

        Parking Spaces:
        {{ Form::selectRange('park_spaces', 1, 4) }}<br><br>

        Square Foot:
        {{ Form::select('sqrfoot', array('1500' => '<1500', '2500' => '1500 - 2500', '2501' => '>2500')) }}<br><br>

        Lot Square Foot:
        {{ Form::select('lot_sqrfoot', array('10K' => '<10K', '40K' => '10K - 40K', '41K' => '>40K')) }}<br><br>

        Garage:
        {{ Form::checkbox('garage', 'true') }}<br><br>

        Pool:
        {{ Form::checkbox('pool', 'true') }}<br><br>

        {{ Form::submit('Submit') }}

    {{ Form::close() }}

@stop