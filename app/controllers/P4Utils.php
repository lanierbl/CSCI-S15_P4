<?php

class P4Utils extends BaseController {

    public function debug()
    {
        echo '<pre>';

        echo '<h1>environment.php</h1>';
        $path   = base_path().'/environment.php';

        try {
            $contents = 'Contents: '.File::getRequire($path);
            $exists = 'Yes';
        }
        catch (Exception $e) {
            $exists = 'No. Defaulting to `production`';
            $contents = '';
        }

        echo "Checking for: ".$path.'<br>';
        echo 'Exists: '.$exists.'<br>';
        echo $contents;
        echo '<br>';

        echo '<h1>Environment</h1>';
        echo App::environment().'</h1>';

        echo '<h1>Debugging?</h1>';
        if(Config::get('app.debug')) echo "Yes"; else echo "No";

        echo '<h1>Database Config</h1>';
        print_r(Config::get('database.connections.mysql'));

        echo '<h1>Test Database Connection</h1>';
        try {
            $results = DB::select('SHOW DATABASES;');
            echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
            echo "<br><br>Your Databases:<br><br>";
            print_r($results);
        }
        catch (Exception $e) {
            echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
        }

        echo '</pre>';
    }


    public function triggerError()
    {
        # Class Foobar should not exist, so this should create an error
        $foo = new Foobar;
    }


    public function getEnvironment()
    {
        echo "Environment: ".App::environment();
    }


    public function refreshDB()
    {
        # Clear the tables to a blank slate
        DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
        echo "TRUNCATE 'users' table"."<br>";
        DB::statement('TRUNCATE users');
        echo "TRUNCATE 'homes' table"."<br>";
        DB::statement('TRUNCATE homes');
        echo "TRUNCATE 'listings' table"."</br>";
        DB::statement('TRUNCATE listings');
        //echo "TRUNCATE 'searches' table"."</br>";
        //DB::statement('TRUNCATE searches');
        DB::statement('SET FOREIGN_KEY_CHECKS=1'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK


        // New Admin User
        echo "<br><br>"."Saving Admin User: <b>'blanier'</b>"."<br>";
        $user = new User;
        $user->username = 'blanier';
        $user->password = Hash::make('password');
        $user->first_name = 'Site Admin';
        $user->last_name = 'User';
        $user->email    = 'admin@p4.cscis15.lanier.us';
        $user->admin = true;
        // Save Admin User
        $user->save();

        // New Listing User
        echo "<br>"."Saving Listing User: <b>'testlister'</b>"."<br>";
        $user = new User;
        $user->username = 'testlister';
        $user->password = Hash::make('password');
        $user->first_name = 'Test Lister';
        $user->last_name = 'User';
        $user->email    = 'testlister@p4.cscis15.lanier.us';
        $user->admin = false;
        // Save Listing User
        $user->save();

        // New Home seed data
        echo "<br><br>"."Saving seed data for <b>'Home'</b> objects"."<br>";
        $home = new Home;
        $home->style = 'Colonial';
        $home->desc = 'A fine home in the center of Cambridge.';
        $home->addr_street = '2500 Massachusetts Ave';
        $home->addr_city = 'Cambridge';
        $home->addr_state = 'MA';
        $home->addr_zip = 2138;
        $home->num_bed = 2;
        $home->num_bath = 2;
        $home->num_halfbath = 1;
        $home->sqrfoot = 2560;
        $home->lot_sqrfoot = 31500;
        $home->park_spaces = 4;
        $home->garage = true;
        $home->pool = false;
        $home->pic1 = '';
        // Save Home seed data
        $home->save();

        $home = new Home;
        $home->style = 'Condo';
        $home->desc = 'Brand new condominium in the heart of Back Bay.';
        $home->addr_street = '125 Stuart Street, Unit 250';
        $home->addr_city = 'Boston';
        $home->addr_state = 'MA';
        $home->addr_zip = 02116;
        $home->num_bed = 2;
        $home->num_bath = 1;
        $home->num_halfbath = 1;
        $home->sqrfoot = 1850;
        $home->lot_sqrfoot = 0;
        $home->park_spaces = 0;
        $home->garage = true;
        $home->pool = true;
        $home->pic1 = '';
        // Save Home seed data
        $home->save();

        // New Listing seed data
        echo "<br>"."Saving seed data for <b>'Listing'</b> objects"."<br>";
        $listing = new Listing;
        $listing->user_id = 2;
        $listing->home_id = 1;
        $listing->status = 'Under Agreement';
        $listing->price = 899500;
        $listing->listing_date = '2013-09-01';
        $listing->status_date = '2014-07-15';
        $listing->save();

        $listing = new Listing;
        $listing->user_id = 99;
        $listing->home_id = 3;
        $listing->status = 'Active';
        $listing->price = 1495000;
        $listing->listing_date = '2014-06-01';
        $listing->status_date = '2014-06-01';
        $listing->save();
    }

}
