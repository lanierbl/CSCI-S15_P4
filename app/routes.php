<?php

/*
|--------------------------------------------------------------------------
| Application Routes
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


Route::get('search', function()
{
    return View::make('search');
});

Route::post('search', array('before' => 'auth',
        'uses' => 'P4Logic@search')
);

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
| Utility / Testing Routes
|--------------------------------------------------------------------------
*/


Route::get('/debug', 'P4Utils@debug');

Route::get('/get-environment', 'P4Utils@getEnvironment');

Route::get('/trigger-error', 'P4Utils@triggerError');

Route::get('/refreshDB', 'P4Utils@refreshDB');