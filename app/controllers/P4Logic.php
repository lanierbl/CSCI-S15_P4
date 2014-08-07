<?php

class P4Logic extends BaseController {

    public function index()
    {
        $state_options = array('Select State' => 'Select State') + DB::table('labels')->where('type', '=', 'state')->orderBy('value', 'asc')->distinct()->lists('value', 'value');
        $city_options = array('Select City' => 'Select City') + DB::table('labels')->where('type', '=', 'city')->orderBy('value', 'asc')->distinct()->lists('value', 'value');
        if (Auth::check()) {
            $style_options = array('Select Style' => 'Select Style') + DB::table('labels')->where('type', '=', 'style')->orderBy('value', 'asc')->distinct()->lists('value', 'value');
            $status_options = array('Select Status' => 'Select Status') + DB::table('labels')->where('type', '=', 'status')->orderBy('value', 'asc')->distinct()->lists('value', 'value');
            return View::make('index', array('state_options' => $state_options,'city_options' => $city_options,
                                             'style_options' => $style_options, 'status_options' => $status_options));
        }
        return View::make('index', array('state_options' => $state_options,'city_options' => $city_options));
    }


    public function search($searchID = null)
    {
        $state_options = array('Select State' => 'Select State') + DB::table('labels')->where('type', '=', 'state')->orderBy('value', 'asc')->distinct()->lists('value', 'value');
        $city_options = array('Select City' => 'Select City') + DB::table('labels')->where('type', '=', 'city')->orderBy('value', 'asc')->distinct()->lists('value', 'value');
        $style_options = array('Select Style' => 'Select Style') + DB::table('labels')->where('type', '=', 'style')->orderBy('value', 'asc')->distinct()->lists('value', 'value');
        if ($searchID != null) {
            $search = Search::find($searchID);
            }
        return View::make('search', array('state_options' => $state_options,
                                          'city_options' => $city_options,
                                          'style_options' => $style_options));
    }


    public function search_do()
    {
        $state = $_POST["state"];
        $whereStmt = "`addr_state` = '$state'";

        $city = $_POST["city"];
        $whereStmt = $whereStmt." AND `addr_city` = '$city'";

        if (isset($_POST['style'])) {
            $style          = $_POST["style"];
            $whereStmt = $whereStmt." AND `style` = '$style'";
        }

        if (isset($_POST['num_bed'])) {
            $num_bed        = $_POST["num_bed"];
            if ($num_bed == "4")
                $whereStmt = $whereStmt." AND `num_bed` > 3";
            else
                $whereStmt = $whereStmt." AND `num_bed` = $num_bed";
        }

        if (isset($_POST['num_bath'])) {
            $num_bath       = $_POST["num_bath"];
            if ($num_bath == "3")
                $whereStmt = $whereStmt." AND `num_bath` > 2";
            else
                $whereStmt = $whereStmt." AND `num_bath` = $num_bath";
        }

        if (isset($_POST['num_halfbath'])) {
            $num_halfbath   = $_POST["num_halfbath"];
            if ($num_halfbath == "2")
                $whereStmt = $whereStmt." AND `num_halfbath` > 1";
            else
                $whereStmt = $whereStmt." AND `num_halfbath` = $num_halfbath";
        }

        if (isset($_POST['park_spaces'])) {
            $park_spaces    = $_POST["park_spaces"];
            if ($park_spaces == "2")
                $whereStmt = $whereStmt." AND `park_spaces` > 1";
            else
                $whereStmt = $whereStmt." AND `park_spaces` = $park_spaces";
        }

        if (isset($_POST['sqrfoot'])) {
            $sqrfoot        = $_POST["sqrfoot"];
            if ($sqrfoot == "1500")
                $whereStmt = $whereStmt." AND `sqrfoot` < 1500";
            elseif ($sqrfoot == "2500")
                $whereStmt = $whereStmt." AND `sqrfoot` > 1500 AND `sqrfoot` < 2500";
            else
                $whereStmt = $whereStmt." AND `sqrfoot` > 2500";
        }

        if (isset($_POST['lot_sqrfoot'])) {
            $lot_sqrfoot    = $_POST["lot_sqrfoot"];
            if ($lot_sqrfoot == "10K")
                $whereStmt = $whereStmt." AND `lot_sqrfoot` < 10000";
            elseif ($lot_sqrfoot == "40K")
                $whereStmt = $whereStmt." AND `lot_sqrfoot` > 10000 AND `lot_sqrfoot` < 40000";
            else
                $whereStmt = $whereStmt." AND `lot_sqrfoot` > 40000";
        }

        if (isset($_POST['garage'])) {
            $whereStmt = $whereStmt." AND `garage` = true";
        }

        if (isset($_POST['pool'])) {
            $whereStmt = $whereStmt." AND `pool` = true";
        }

        $result = DB::table('homes')->whereRaw($whereStmt)->get();

        return (array('results'=> $result, 'flash_message'=>'Search Results'));
    }

    public function list_do() {

        $home = new Home;
        $home->addr_street     = ($_POST['addr_street']);
        $home->addr_city       = ($_POST['addr_city']);
        $home->addr_state      = ($_POST['addr_state']);
        $home->style           = ($_POST['style']);
        $home->desc            = ($_POST['desc']);
        $home->num_bed         = ($_POST['num_bed']);
        $home->num_bath        = ($_POST['num_bath']);
        $home->num_halfbath    = ($_POST['num_halfbath']);
        $home->sqrfoot         = ($_POST['sqrfoot']);
        $home->lot_sqrfoot     = ($_POST['lot_sqrfoot']);
        $home->park_spaces     = ($_POST['park_spaces']);
        $home->pic1            = ($_POST['pic']);
        if ($_POST['garage'] = 1) {$home->garage = true;} else {$home->garage = false;};
        if ($_POST['pool'] = 1) {$home->pool = true;} else {$home->pool = false;};
        if (!$home->save()) {
            return (array('type'=>'error', 'text'=>'Error saving Home'));
        }
        $listing = new Listing;
        $listing->user_id      = Auth::user()->id;
        $listing->home_id      = $home->id;
        $listing->status          = ($_POST['status']);
        $listing->price           = ($_POST['price']);
        if (!$listing->save()) {
            Home::destroy($home->id);
            return (array('type'=>'error', 'text'=>'Error saving Listing'));
        }

        //  Send back JSON array
        return (array('type'=>'success', 'text'=>'Saved Listing', 'listID' => $listing->id));
    }

    public function search_save()
    {
        // New Search
        $search = new Search;
        $search->user_id = Auth::user()->id;
        $search->name = $_POST["searchName"];
        $search->searchValJSON = json_encode($_POST["searchString"]);
        // Save new Search
        $search->save();
    }

    public function search_delete($searchID)
    {
        $search = Search::find($searchID);
        $userID = Auth::user()->id;
        if($userID == $search->user_id) {
            Search::destroy($searchID);
            return Redirect::to('/')->with('flash_type', 'success')->with('flash_message', 'Saved Search deleted successfully');
        } else {
            return Redirect::to('/')->with('flash_type', 'danger')->with('flash_message', 'Saved Search not Deleted');
        }
    }

    public function home_detail($homeID)
    {
        $home = Home::find($homeID);
        return View::make('homedetail', array('home' => $home));
    }

    public function admin()
    {
        if (Auth::user()->admin) {
            return View::make('admin');
        }
        return Redirect::to('/')->with('flash_type', 'danger')->with('flash_message', 'Not an Admin of P4 Site!');
    }


}
