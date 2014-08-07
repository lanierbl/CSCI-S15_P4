@extends('_master')

@section('title')
Domo
@stop

@section('head')

    {{ HTML::style('fonts/font-awesome-4.1.0/css/font-awesome.min.css') }}
    <!-- Bootstrap CSS -->
    {{ HTML::style('css/bootstrap.min.css') }}
    <!-- Index Style CSS -->
    {{ HTML::style('css/index.css') }}

    <style>
        .header {
            background-image: url({{URL::asset('images/bg.jpg')}});
        }
    </style>

@stop

@section('body')

    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                                Navigation                                                  -->
    <!---------------------------------------------------------------------------------------------------------------->

    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top">Domo</a>
            </li>
            <li>
                <a href="#top">Home</a>
            </li>
            <li>
                <a href="#contact">Contact</a>
            </li>
            <br>
            <li>
                <a href="#search">Search for a Place</a>
            </li>
            @if(Auth::check())
                <li><a href="#list">List a Place</a></li>
                    @if(Auth::user()->admin)
                        <br>
                        <li><a href='#admin'>Admin</a></li>
                    @endif
                <br>
                <li><a href='/logout'>Log out</a></li>
            @else
                <br>
                <li><a data-toggle="modal" data-target="#regModal">Register</a></li>
                <li><a data-toggle="modal" data-target="#loginModal">Login</a></li>
            @endif
        </ul>
    </nav>

    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                                Login Modal                                                 -->
    <!---------------------------------------------------------------------------------------------------------------->

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Login</h4>
          </div>
          <div class="modal-body">
            {{ Form::open(array('url' => url('/login'), 'class' => 'form-horizontal', 'role' => 'form')) }}
                <div class="form-group">
                    {{ Form::label('username','Username', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('password','Password', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                    </div>
                </div>
          </div>
          <div class="modal-footer">
                {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'id' => 'submit-login']) }}
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>

    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                         Registration Modal                                                 -->
    <!---------------------------------------------------------------------------------------------------------------->
    <div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Registration</h4>
          </div>
          <div class="modal-body">
            {{ Form::open(array('url' => url('/register'), 'class' => 'form-horizontal', 'role' => 'form')) }}
                <div class="form-group">
                    {{ Form::label('first_name','First Name', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('last_name','Last Name', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email','Email', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email address']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('username','Username', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('password','Password', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Password']) }}
                    </div>
                </div>
          </div>
          <div class="modal-footer">
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>

    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                         Home Listing Modal                                                 -->
    <!---------------------------------------------------------------------------------------------------------------->

    <div class="modal fade" id="homeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Home Details</h4>
          </div>
          <div class="modal-body">
            <div class="homedetail">
                <input type="text" name="homeID" id="homeID" value=""/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                                  Header                                                    -->
    <!---------------------------------------------------------------------------------------------------------------->

    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>Domo</h1>
            <h3>Find Your Place</h3>
            <br>
            <a href="#search" class="btn btn-dark btn-lg">Get Started</a>
        </div>
    </header>

    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                                Search                                                      -->
    <!---------------------------------------------------------------------------------------------------------------->

    <section id="search" class="search bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h1>Search For A Place</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <section id="searchform" class="searchform">
        <div class="container">
            <div class="row">
                <fieldset id="search_form">
                    <div class="col-md-4">
                        <div class="col-md-6 search_div">

                            <div class="form-group">
                                {{ Form::label('state','State', array('class' => 'control-label')) }}
                                {{ Form::select('state', array('Select State' => 'Select State'), null, ['class' => 'form-control small-select', 'id' => 'state']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('city','City', array('class' => 'control-label')) }}
                                {{ Form::select('city', array('Select City' => 'Select City'), null, ['class' => 'form-control small-select', 'id' => 'city']) }}
                            </div>

                            @if(Auth::check())

                                <div class="form-group">
                                    {{ Form::label('style','Style', array('class' => 'control-label')) }}
                                    {{ Form::select('style', array('Select Style' => 'Select Style'), null, array('class' => 'form-control small-select', 'id' => 'style')) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('num_bed','Bedrooms', array('class' => 'control-label')) }}
                                    {{ Form::select('num_bed', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4+'), null, array('class' => 'form-control small-select', 'id' => 'num_bed')) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('num_bath','Bathrooms', array('class' => 'control-label')) }}
                                    {{ Form::select('num_bath', array('' => '', '1' => '1', '2' => '2', '3' => '3+'), null, array('class' => 'form-control small-select', 'id' => 'num_bath')) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('num_halfbath','Half Bathrooms', array('class' => 'control-label')) }}
                                    {{ Form::select('num_halfbath', array('' => '', '1' => '1', '2' => '2+'), null, array('class' => 'form-control small-select', 'id' => 'num_halfbath')) }}
                                </div>
                                {{ Form::hidden('guest', 'false', ['id' => 'guest']) }}
                            @else

                                {{ Form::hidden('guest', 'true', ['id' => 'guest']) }}
                                <div class="text-center">
                                    <br><br><h4>Create an Account<br>for additional search criteria!</h4>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 search_div">
                            @if(Auth::check())
                                <div class="form-group">
                                    {{ Form::label('park_spaces','Parking Spaces', array('class' => 'control-label')) }}
                                    {{ Form::select('park_spaces', array('' => '', '1' => '1', '2' => '2+'), null, array('class' => 'form-control small-select', 'id' => 'park_spaces')) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('sqrfoot','Square Foot', array('class' => 'control-label')) }}
                                    {{ Form::select('sqrfoot', array('' => '', '1500' => '<1500', '2500' => '1500 - 2500', '2501' => '>2500'), null, array('class' => 'form-control small-select', 'id' => 'sqrfoot')) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('lot_sqrfoot','Lot Square Foot', array('class' => 'control-label')) }}
                                    {{ Form::select('lot_sqrfoot', array('' => '', '10K' => '<10K', '40K' => '10K - 40K', '41K' => '>40K'), null, array('class' => 'form-control small-select', 'id' => 'lot_sqrfoot')) }}
                                </div>

                                <div class="checkbox">
                                    {{ Form::checkbox('garage','1') }}
                                    {{ Form::label('garage','Garage') }}
                                </div>

                                <div class="checkbox">
                                    {{ Form::checkbox('pool','1') }}
                                    {{ Form::label('pool','Pool') }}
                                </div>

                                <br>
                                <div class="form-group">
                                    {{ Form::label('searchName','Save Search', array('class' => 'control-label')) }}
                                    {{ Form::text('searchName', null, ['class' => 'form-control', 'placeholder' => 'Search Name']) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class = "results_div">
                            <h4>Search Results</h4>
                            <br>
                            <div id="result"></div>
                        </div> <!-- /.results-div -->
                    </div>
                </fieldset>
            </div>  <!--  ./row  -->
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <div class="text-center">
                        {{ Form::submit('Search For Homes!', ['id' => 'search_submit', 'class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            </div>
        </div>  <!--  /.container  -->
    </section>  <!--  /.searchform  -->

    @if(Auth::check())
        <section id="mysearch" class="mysearch bg-primary">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h2>My Search</h2>
                    </div>
                    <div class="col-md-8">
                        <div id="mySearches"></div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
    @endif

    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                               List A Place                                                 -->
    <!---------------------------------------------------------------------------------------------------------------->

    @if(Auth::check())

    <section id="list" class="list bg-info">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h1>List A Place</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <section id="listform" class="listform">
        <div class="container">
            <fieldset id="list_form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('list_street','Address', array('class' => 'control-label')) }}
                            {{ Form::text('list_street', null, ['id' => 'list_street', 'class' => 'form-control', 'placeholder' => 'Street']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_city','City', array('class' => 'control-label')) }}
                            {{ Form::select('list_city', array('Select City' => 'Select City'), null, array('class' => 'form-control', 'id' => 'list_city')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_state','State', array('class' => 'control-label')) }}
                            {{ Form::select('list_state', array('Select State' => 'Select State'), null, array('class' => 'form-control', 'id' => 'list_state')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_style','Style', array('class' => 'control-label')) }}
                            {{ Form::select('list_style', array('Select Style' => 'Select Style'), null, array('class' => 'form-control', 'id' => 'list_style')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_num_bed','Bedrooms', array('class' => 'control-label')) }}
                            {{ Form::select('list_num_bed', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'), null, array('class' => 'form-control', 'id' => 'list_num_bed')) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('list_num_bath','Bathrooms', array('class' => 'control-label')) }}
                            {{ Form::select('list_num_bath', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'), null, array('class' => 'form-control', 'id' => 'list_num_bath')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_num_halfbath','Half Bathrooms', array('class' => 'control-label')) }}
                            {{ Form::select('list_num_halfbath', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4'), null, array('class' => 'form-control', 'id' => 'list_num_halfbath')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_park_spaces','Parking Spaces', array('class' => 'control-label')) }}
                            {{ Form::select('list_park_spaces', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4'), null, array('class' => 'form-control', 'id' => 'list_park_spaces')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_sqrfoot','Square Foot', array('class' => 'control-label')) }}
                            {{ Form::text('list_sqrfoot', null, ['id' => 'list_sqrfoot', 'class' => 'form-control', 'placeholder' => 'Square Foot of Home']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_lot_sqrfoot','Lot Square Foot', array('class' => 'control-label')) }}
                            {{ Form::text('list_lot_sqrfoot', null, ['id' => 'list_lot_sqrfoot', 'class' => 'form-control', 'placeholder' => 'Square Foot of Lot']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('list_status','Listing Status', array('class' => 'control-label')) }}
                            {{ Form::select('list_status', array('Select Status' => 'Select Status'), null, array('class' => 'form-control', 'id' => 'list_status', 'placeholder' => 'Listing Status')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_price','Listing Price', array('class' => 'control-label')) }}
                            {{ Form::text('list_price', null, ['id' => 'list_price', 'class' => 'form-control', 'placeholder' => '$']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('list_desc','Description', array('class' => 'control-label')) }}
                            {{ Form::textarea('list_desc', null, ['id' => 'list_desc', 'class' => 'form-control', 'rows' => '6', 'placeholder' => 'Description']) }}
                        </div>
                        <div class="checkbox">
                            {{ Form::checkbox('list_garage','1', null, ['id' => 'list_garage']) }}
                            {{ Form::label('list_garage','Garage') }}
                        </div>
                        <div class="checkbox">
                            {{ Form::checkbox('list_pool','1', null, ['id' => 'list_pool']) }}
                            {{ Form::label('list_pool','Pool') }}
                        </div>
                    </div> <!-- /.col-md-4 -->
                </div>  <!-- /.row -->
                <div class="row">
                    <div class="text-center">
                        {{ Form::hidden('list_pic', '', ['id' => 'list_pic']) }}
                        {{ Form::submit('List Your Home!', ['id' => 'list_submit', 'class' => 'btn btn-primary btn-lg']) }}
                    </div>
                <div>
            </fieldset>  <!-- fieldset ---->
            <div class="row">
                <div class="col-md-12">
                    <h3>Listing Results</h3>
                    <br>
                    <div id="list_result"></div>
                </div>
            </div>  <!--  /.row   -->
        </div>  <!-- /.container -->
    </section>

    <section id="mylist" class="mylist bg-info">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <h2>My Listings</h2>
                </div>
                <div class="col-md-8">
                    <div id="myListings"></div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>


        @if(Auth::user()->admin)
    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                                Admin                                                       -->
    <!---------------------------------------------------------------------------------------------------------------->

        <section id="admin" class="admin bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <h1>Admin</h1>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>

        <section id="adminBody" class="adminBody">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <h2><span class="label label-default">City</span></h2>
                        <br><br>
                        <fieldset class="form-inline" role="form">
                          <div class="form-group">
                            {{ Form::label('add_city','New City', array('class' => 'control-label sr-only')) }}
                            {{ Form::text('add_city', null, ['id' => 'add_city', 'class' => 'form-control', 'placeholder' => 'New City']) }}
                          </div>
                          {{ Form::submit('Add', ['id' => 'addCity_submit', 'class' => 'btn btn-primary']) }}
                        </fieldset>
                        <br><br>
                        <div id="current_city"></div>
                    </div>
                    <div class="col-md-3 text-center">
                        <h2><span class="label label-default">States</span></h2>
                        <br><br>
                        <fieldset class="form-inline" role="form">
                          <div class="form-group">
                            {{ Form::label('add_state','New State', array('class' => 'control-label sr-only')) }}
                            {{ Form::text('add_state', null, ['id' => 'add_state', 'class' => 'form-control', 'placeholder' => 'New State']) }}
                          </div>
                          {{ Form::submit('Add', ['id' => 'addState_submit', 'class' => 'btn btn-primary']) }}
                        </fieldset>
                        <br><br>
                        <div id="current_state"></div>
                    </div>
                    <div class="col-md-3 text-center">
                        <h2><span class="label label-default">Styles</span></h2>
                        <br><br>
                        <fieldset class="form-inline" role="form">
                          <div class="form-group">
                            {{ Form::label('add_style','New Style', array('class' => 'control-label sr-only')) }}
                            {{ Form::text('add_style', null, ['id' => 'add_style', 'class' => 'form-control', 'placeholder' => 'New Style']) }}
                          </div>
                          {{ Form::submit('Add', ['id' => 'addStyle_submit', 'class' => 'btn btn-primary']) }}
                        </fieldset>
                        <br><br>
                        <div id="current_style"></div>
                    </div>
                    <div class="col-md-3 text-center">
                        <h2><span class="label label-default">Status</span></h2>
                        <br><br>
                        <fieldset class="form-inline" role="form">
                          <div class="form-group">
                            {{ Form::label('add_status','New Status', array('class' => 'control-label sr-only')) }}
                            {{ Form::text('add_status', null, ['id' => 'add_status', 'class' => 'form-control', 'placeholder' => 'New Status']) }}
                          </div>
                          {{ Form::submit('Add', ['id' => 'addStatus_submit', 'class' => 'btn btn-primary']) }}
                        </fieldset>
                        <br><br>
                        <div id="current_status"></div>
                    </div>
                </div>
            </div>  <!-- /.container -->
        </section>

        <section id="adminFtr" class="adminFtr bg-primary">
            <div class="container">
            </div>
            <!-- /.container -->
        </section>

       @endif
    @endif

    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                                Footer                                                      -->
    <!---------------------------------------------------------------------------------------------------------------->

    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <hr class="large">
                    <h4><strong>Brent Lanier</strong></h4>
                    <p>CSCI S-15 - Summer 2014<br>Harvard University</p>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="https://www.linkedin.com/in/brentlanier"><i class="fa fa-linkedin fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="https://github.com/lanierbl"><i class="fa fa-github fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/lanierbl"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

@stop

@section('scripts')

    <!---------------------------------------------------------------------------------------------------------------->
    <!--                                                Scripts                                                     -->
    <!---------------------------------------------------------------------------------------------------------------->

    {{ HTML::script('scripts/index.js') }}

    <script>


    </script>

@stop