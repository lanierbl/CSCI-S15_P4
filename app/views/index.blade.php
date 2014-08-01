@extends('_master')

@section('title')
CSCI S-15 - Summer 2014 - Project 4
@stop

@section('head')
@stop

@section('content')

    <h1>Welcome to P4</h1>

    <a href="/my/listings">My Listings</a>
    <br>
    <a href="/my/searches">My Searches</a>
    <br>
    <a href="/search">Search for Homes</a>
    <br>
    @if(Auth::check())
        <a href='/home/list'>List a Home for Sale</a>
    @endif

@stop