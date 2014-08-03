@extends('_master')

@section('title')
List Home For Sale
@stop

@section('head')
    {{ HTML::script('scripts/newlisting.js') }}
@stop

@section('body')

    <h1>List a Home For Sale</h1>

    <div class = "list_div">
        <fieldset id="list_form">

            {{ Form::label('street','Address: ') }}
            {{ Form::text('street', null, ['id' => 'street']) }}<br><br>

            {{ Form::label('state','State: ') }}
            {{ Form::select('state', array('Select State' => 'Select State'), ['id' => 'state']) }}<br><br>

            {{ Form::label('city','City: ') }}
            {{ Form::select('city', array('Select State First' => 'Select State First'), ['id' => 'city']) }}<br><br>

            {{ Form::label('desc','Description: ') }}
            {{ Form::text('desc', null, ['id' => 'desc']) }}<br><br>

            {{ Form::label('style','Style: ') }}
            {{ Form::select('style', array('Select Style' => 'Select Style'), ['id' => 'style']) }}<br><br>

            {{ Form::label('num_bed','Bedrooms:') }}
            {{ Form::select('num_bed', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'), ['id' => 'num_bed']) }}<br><br>

            {{ Form::label('num_bath','Bathrooms: ') }}
            {{ Form::select('num_bath', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4'), ['id' => 'num_bath']) }}<br><br>

            {{ Form::label('num_halfbath','Half Bathrooms: ') }}
            {{ Form::select('num_halfbath', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4'), ['id' => 'num_halfbath']) }}<br><br>

            {{ Form::label('park_spaces','Parking Spaces: ') }}
            {{ Form::select('park_spaces', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4'), ['id' => 'park_spaces']) }}<br><br>

            {{ Form::label('sqrfoot','Square Foot: ') }}
            {{ Form::text('sqrfoot', null, ['id' => 'sqrfoot']) }}<br><br>

            {{ Form::label('lot_sqrfoot','Lot Square Foot: ') }}
            {{ Form::text('lot_sqrfoot', null, ['id' => 'lot_sqrfoot']) }}<br><br>

            {{ Form::label('garage','Garage: ') }}
            {{ Form::checkbox('garage','1') }}<br><br>

            {{ Form::label('pool','Pool: ') }}
            {{ Form::checkbox('pool','1') }}<br><br>

            {{ Form::label('searchName','Save Search Name: ') }}
            {{ Form::text('searchName') }}<br><br>


            {{ Form::submit('List Home!', ['id' => 'submit']) }}

        </fieldset>
    </div> <!-- /list-div -->

    <div class = "results_div">
        Search Results
        <div id="result"></div>
    </div> <!-- /results-div -->

@stop

@section('scripts')
@stop