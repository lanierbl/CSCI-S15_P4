@extends('_master')

@section('title')
Search
@stop

@section('head')
    {{ HTML::script('scripts/search.js') }}
@stop

@section('body')

    <h1>Search</h1>

    <div class = "search_div">
        <fieldset id="search_form">

        {{ Form::label('state','State: ') }}
                {{ Form::select('state', array('Select State' => 'Select State'), ['id' => 'state']) }}<br><br>

                {{ Form::label('city','City: ') }}
                {{ Form::select('city', array('Select State First' => 'Select State First'), ['id' => 'city']) }}<br><br>

                @if(Auth::check())

                    {{ Form::label('style','Style: ') }}
                    {{ Form::select('style', array('Select Style' => 'Select Style'), ['id' => 'style']) }}<br><br>








            {{ Form::label('state','State: ') }}
            {{ Form::select('state', $state_options, ['id' => 'state']) }}<br><br>

            {{ Form::label('city','City: ') }}
            {{ Form::select('city', $city_options, ['id' => 'city']) }}<br><br>

            @if(Auth::check())

                {{ Form::label('style','Style: ') }}
                {{ Form::select('style', $style_options, ['id' => 'style']) }}<br><br>

                {{ Form::label('num_bed','Bedrooms:') }}
                {{ Form::select('num_bed', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4+'), ['id' => 'num_bed']) }}<br><br>

                {{ Form::label('num_bath','Bathrooms: ') }}
                {{ Form::select('num_bath', array('' => '', '1' => '1', '2' => '2', '3' => '3+'), ['id' => 'num_bath']) }}<br><br>

                {{ Form::label('num_halfbath','Half Bathrooms: ') }}
                {{ Form::select('num_halfbath', array('' => '', '1' => '1', '2' => '2+'), ['id' => 'num_halfbath']) }}<br><br>

                {{ Form::label('park_spaces','Parking Spaces: ') }}
                {{ Form::select('park_spaces', array('' => '', '1' => '1', '2' => '2+'), ['id' => 'park_spaces']) }}<br><br>

                {{ Form::label('sqrfoot','Square Foot: ') }}
                {{ Form::select('sqrfoot', array('' => '', '1500' => '<1500', '2500' => '1500 - 2500', '2501' => '>2500'), ['id' => 'sqrfoot']) }}<br><br>

                {{ Form::label('lot_sqrfoot','Lot Square Foot: ') }}
                {{ Form::select('lot_sqrfoot', array('' => '', '10K' => '<10K', '40K' => '10K - 40K', '41K' => '>40K'), ['id' => 'lot_sqrfoot']) }}<br><br>

                {{ Form::label('garage','Garage: ') }}
                {{ Form::checkbox('garage','1') }}<br><br>

                {{ Form::label('pool','Pool: ') }}
                {{ Form::checkbox('pool','1') }}<br><br>

                {{ Form::label('searchName','Save Search Name: ') }}
                {{ Form::text('searchName') }}<br><br>

                {{ Form::hidden('guest', 'false', ['id' => 'guest']) }}

            @else

                {{ Form::hidden('guest', 'true', ['id' => 'guest']) }}
                Create an Account for additional search criteria!<br><br>
            @endif

            {{ Form::submit('Search For Homes!', ['id' => 'submit']) }}

        </fieldset>
    </div> <!-- /search-div -->

    <div class = "results_div">
        Search Results
        <div id="result"></div>
    </div> <!-- /results-div -->

@stop

@section('scripts')

    <script type="text/javascript">
        var searchJSON = <?php echo $searchJSON; ?>;
        if (searchJSON != 'none') {
            $.each(searchJSON, function(name, val) {
                //alert('Name = ' + name + ', Value = ' + val);
                var $el = $('[name="' + name + '"]'),
                    type = $el.attr('type');

                switch (type) {
                    case 'checkbox':
                        $el.attr('checked', 'checked');
                        break;
                    case 'radio':
                        $el.filter('[value="' + val + '"]').attr('checked', 'checked');
                        break;
                    default:
                        $el.val(val);
                }
            });
        }

    </script>

@stop