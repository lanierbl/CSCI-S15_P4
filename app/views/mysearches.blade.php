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
             <p>Search ID:  {{ $s->id }}</p>
             <p>Search Name:  {{ $s->name }}</p>
             <br>
         @endforeach

     @stop