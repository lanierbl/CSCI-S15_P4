<?php

/*
|--------------------------------------------------------------------------
| Authentication / Login / Registration Routes
|--------------------------------------------------------------------------
*/
/*
Route::get('/', function()
{
    return View::make('index');
});*/


Route::get('/', 'P4Logic@index');

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

Route::get('/home/list', array('before' => 'auth',
        function() {
            return View::make('newlisting');
        }
    )
);

Route::get('/home/detail/{homeID}', 'P4Logic@home_detail');


Route::get('/search/{searchID?}', 'P4Logic@search');


Route::post('/search/do', 'P4Logic@search_do');


Route::post('/search/save', 'P4Logic@search_save');


Route::get('/search/delete/{searchID}', array('before' => 'auth',
                                        'uses' => 'P4Logic@search_delete')
);


Route::get('/my/listings', array('before' => 'auth',
        function() {
            $listings = Auth::user()->listings()->get();
            return View::make('mylistings', array('listings' => $listings));
        }
    )
);


Route::get('/my/searches', array('before' => 'auth',
        function() {
            $searches = Auth::user()->searches()->get();
            return View::make('mysearches', array('searches' => $searches));
        }
    )
);


Route::get('/admin', array('before' => 'auth',
        'uses' => 'P4Logic@admin')
);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


Route::get('/api/get_states',
        function() {
            $states = DB::table('labels')->where('type', '=', 'state')->orderBy('value', 'asc')->distinct()->lists('value');
            return Response::make($states);
        }
);


Route::get('/api/get_cities',
        function() {
            $state = Input::get('option');
            $cities = DB::table('labels')->where('type', '=', 'city')->orderBy('value', 'asc')->distinct()->lists('value', 'value');
            return Response::make($cities);
        }
);

Route::get('/api/get_styles',
        function() {
            $styles = DB::table('labels')->where('type', '=', 'style')->orderBy('value', 'asc')->distinct()->lists('value');;
            return Response::make($styles);
        }
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