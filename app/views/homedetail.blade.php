@extends('_master')

@section('title')
    Home Detail
@stop

@section('head')
@stop

@section('body')

    <h1>Home Detail</h1>

    <p>Home ID:  {{ $home->id }}</p>
    <p>City:  {{ $home->addr_city }}</p>
    <br>

@stop

@section('scripts')
@stop