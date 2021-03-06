<?php

class P4Utils extends BaseController {


    /*
     * debug()
     *
     * Debug screen - Displays relevant information about environment.
     *
    */

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


    /*
     * triggerError()
     *
     * Simulates a system error for diagnostic purposes
     *
    */

    public function triggerError()
    {
        # Class Foobar should not exist, so this should create an error
        $foo = new Foobar;
    }


    /*
     * getEnvironment()
     *
     * Returns Environment variable setting
     *
    */

    public function getEnvironment()
    {
        echo "Environment: ".App::environment();
    }


    /*
     * refreshDB()
     *
     * Populates DB with seed data.
     *
    */

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
        echo "TRUNCATE 'searches' table"."</br>";
        DB::statement('TRUNCATE searches');
        echo "TRUNCATE 'labels' table"."</br>";
        DB::statement('TRUNCATE labels');
        DB::statement('SET FOREIGN_KEY_CHECKS=1'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK

        // New Admin User
        echo "<br><br>"."Saving Admin User: <b>'blanier'</b>"."<br>";
        $user = new User;
        $user->username = 'admin';
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
        $user->username = 'test';
        $user->password = Hash::make('password');
        $user->first_name = 'Test';
        $user->last_name = 'User';
        $user->email    = 'test@p4.cscis15.lanier.us';
        $user->admin = false;
        // Save Listing User
        $user->save();

        // New Label seed data
        echo "<br><br>"."Saving seed data for <b>'Label'</b> objects"."<br>";
        $label = new Label;
        $label->type = 'state';
        $label->value = 'MA';
        $label->save();

        $label = new Label;
        $label->type = 'city';
        $label->value = 'Boston';
        $label->save();

        $label = new Label;
        $label->type = 'city';
        $label->value = 'Cambridge';
        $label->save();

        $label = new Label;
        $label->type = 'city';
        $label->value = 'Arlington';
        $label->save();

        $label = new Label;
        $label->type = 'city';
        $label->value = 'Brookline';
        $label->save();

        $label = new Label;
        $label->type = 'style';
        $label->value = 'Colonial';
        $label->save();

        $label = new Label;
        $label->type = 'style';
        $label->value = 'Ranch';
        $label->save();

        $label = new Label;
        $label->type = 'style';
        $label->value = 'Condo';
        $label->save();

        $label = new Label;
        $label->type = 'status';
        $label->value = 'Active';
        $label->save();

        $label = new Label;
        $label->type = 'status';
        $label->value = 'Under Agreement';
        $label->save();

        // New Home seed data
        echo "<br>"."Saving seed data for <b>'Home'</b> objects"."<br>";
        $home = new Home;
        $home->style = 'Colonial';
        $home->desc = 'A fine home in the center of Cambridge.';
        $home->addr_street = '2500 Massachusetts Ave';
        $home->addr_city = 'Cambridge';
        $home->addr_state = 'MA';
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

        $home = new Home;
        $home->style = 'Ranch';
        $home->desc = 'Charming ranch near Harvard University';
        $home->addr_street = '200 Ash Street';
        $home->addr_city = 'Cambridge';
        $home->addr_state = 'MA';
        $home->num_bed = 3;
        $home->num_bath = 2;
        $home->num_halfbath = 1;
        $home->sqrfoot = 1975;
        $home->lot_sqrfoot = 6500;
        $home->park_spaces = 0;
        $home->garage = true;
        $home->pool = false;
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
        $listing->save();

        $listing = new Listing;
        $listing->user_id = 2;
        $listing->home_id = 2;
        $listing->status = 'Active';
        $listing->price = 1495000;
        $listing->save();

        $listing = new Listing;
        $listing->user_id = 2;
        $listing->home_id = 3;
        $listing->status = 'Active';
        $listing->price = 799500;
        $listing->save();
    }

}
