@extends('_master')

@section('title')
    My Listings
@stop

@section('head')
@stop

@section('content')

    <h1>My Listings</h1>

    @if(count($listings) == 0)
        <p>No Listings</p>
    @endif


    @foreach($listings as $l)
        <p>Listing ID:  {{ $l->id }}</p>
        <p>Listing Status:  {{ $l->status }}</p>
        <br>
    @endforeach

@stop