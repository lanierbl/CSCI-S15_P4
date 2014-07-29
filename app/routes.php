<?php

/*
|--------------------------------------------------------------------------
| Authentication / Login / Registration Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function()
{
    return View::make('index');
});

Route::get('/logout', 'P4Security@logout');


Route::get('register', array('before' => 'guest',
        function() {
            return View::make('register');
        }
    )
);

Route::post('register', array('before' => 'csrf',
                            'uses' => 'P4Security@register')
);

Route::get('login', array('before' => 'guest',
        function() {
            return View::make('login');
        }
    )
);

Route::post('login', array('before' => 'csrf',
                            'uses' => 'P4security@login')
);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/search', array('before' => 'auth',
        function() {
            return View::make('search');
        }
    )
);

Route::post('search', 'P4Logic@search');

Route::get('/mylistings', array('before' => 'auth',
        function() {
            $listings = Auth::user()->listings()->get();
            return View::make('mylistings', array('listings' => $listings));
        }
    )
);

Route::get('/mysearches', array('before' => 'auth',
        function() {
            $searches = Auth::user()->searches()->get();
            return View::make('mysearches', array('searches' => $searches));
        }
    )
);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


Route::get('/api/get_states', array('before' => 'auth',
        function() {
            $states = DB::table('homes')->distinct()->lists('addr_state');
            return Response::make($states);
        }
    )
);


Route::get('/api/get_cities', array('before' => 'auth',
        function() {
            $state = Input::get('option');
            $cities = DB::table('homes')->where('addr_state', '=', $state)->distinct()->lists('addr_city');
            return Response::make($cities);
        }
    )
);

Route::get('/api/get_styles', array('before' => 'auth',
        function() {
            $styles = DB::table('homes')->distinct()->lists('style');
            return Response::make($styles);
        }
    )
);


/*
|--------------------------------------------------------------------------
| Testing Routes
|--------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| Utility Routes
|--------------------------------------------------------------------------
*/


Route::get('/debug', 'P4Utils@debug');

Route::get('/get-environment', 'P4Utils@getEnvironment');

Route::get('/trigger-error', 'P4Utils@triggerError');

Route::get('/refreshDB', 'P4Utils@refreshDB');

Route::get('/practice', function()
{
    echo 'Hello World!';
});