@extends('_master')

@section('title')
    List Home For Sale
@stop

@section('head')
    {{ HTML::script('scripts/newlisting.js') }}
@stop

@section('content')

    <h1>List a Home For Sale</h1>

    <fieldset id="list_form">

        {{ Form::model($home) }}

        {{ Form::submit('List your Home!', ['id' => 'submit']) }}

    </fieldset>


@stop