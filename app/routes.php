<?php

/*
|--------------------------------------------------------------------------
| Authentication / Login / Registration Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function() {
    return View::make('index');
});

Route::get('/logout', 'P4Security@logout');

Route::post('/register', 'P4Security@register');

Route::post('/login', 'P4Security@login');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::post('/search/do', 'P4Logic@search_do');


Route::post('/search/save', 'P4Logic@search_save');


Route::get('/search/delete/{searchID}', array('before' => 'auth',
                                        'uses' => 'P4Logic@search_delete')
);

Route::post('/list/do', 'P4Logic@list_do');


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Returns listing of labels based on value passed
Route::get('/api/get/label/{label}',
    function($label) {
        $data = DB::table('labels')->where('type', '=', $label)->orderBy('value', 'asc')->distinct()->lists('value');
        return Response::make($data);
    }
);

// Returns JSON string of saved search
Route::post('/api/get/searchJSON', array('before' => 'auth',
    function() {
        $searchID   = $_POST["searchID"];
        $search = Search::find($searchID);
        $JSONstring = $search->searchValJSON;
        return Response::make(array('searchJSON' => json_decode($JSONstring)));
    })
);

// Returns home object of detail data
Route::post('/api/get/homeDetail',
    function() {
        $homeID   = $_POST["homeID"];
        $home = Home::find($homeID);
        return Response::make($home);
    }
);

// Returns saved searches of user
Route::get('/api/get/mySearches', array('before' => 'auth',
    function() {
        $searches = Auth::user()->searches()->orderBy('updated_at', 'desc')->get();
        return Response::make($searches);
    })
);

// Returns saved listings of user
Route::get('/api/get/myListings', array('before' => 'auth',
    function() {
        $listings = Auth::user()->listings()->orderBy('updated_at', 'desc')->get();
        return Response::make($listings);
    })
);

// Deletes Search object after validating user
Route::post('/api/delete/search',
    function() {
        $search = Search::find($_POST["searchID"]);
        $userID = Auth::user()->id;
        if($userID == $search->user_id) {
            Search::destroy($search->id);
            return Response::make(array('action' => 'success', 'message'=>'Saved Search deleted successfully'));
        } else {
            return Response::make(array('action' => 'error', 'message'=>'Saved Search not Deleted'));
        }
    }
);

// Adds new label value based on type
Route::post('/api/add/label',
    function() {
        $label = new Label;
        $label->type = ($_POST["label"]);
        $label->value = ($_POST["value"]);
        $label->save();
        return Response::make(array('action' => 'success', 'message'=>'Label saved successfully'));
    }
);

// Deletes Listing object after validating user
Route::post('/api/delete/listing',
    function() {
        $listing = Listing::find($_POST["listingID"]);
        $userID = Auth::user()->id;
        if($userID == $listing->user_id) {
            $home = Home::find($listing->home_id);
            Listing::destroy($listing->id);
            Home::destroy($home->id);
            return Response::make(array('action' => 'success', 'message'=>'Listing deleted successfully'));
        } else {
            return Response::make(array('action' => 'error', 'message'=>'Listing not Deleted'));
        }
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