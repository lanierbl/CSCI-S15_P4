@extends('_master')

     @section('title')
         My Searches
     @stop

     @section('head')
     @stop

     @section('content')

         <h1>My Listings</h1>

         @if(count($searches) == 0)
             <p>No Searches</p>
         @endif


         @foreach($searches as $s)
             <p>Search ID:  <a href="/search/{{ $s->id }}">{{ $s->id }}</a></p>
             <p>Search Name:  {{ $s->name }}   <a href="/search/delete/{{ $s->id }}">Delete</a></p>
             <br>
         @endforeach

     @stop