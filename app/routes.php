<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/debug', 'P4Utils@debug');

Route::get('/get-environment', 'P4Utils@getEnvironment');

Route::get('/trigger-error', 'P4Utils@triggerError');



Route::get('/', function()
{
    return View::make('index');
});


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

Route::get('/logout', 'P4Security@logout');