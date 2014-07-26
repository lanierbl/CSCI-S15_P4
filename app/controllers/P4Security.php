<?php

class P4Security extends BaseController {

    public function register()
    {
        $user = new User;
        $user->email    = Input::get('email');
        $user->password = Hash::make(Input::get('password'));

        # Try to add the user
        try {
            $user->save();
        }
            # Fail
        catch (Exception $e) {
            return Redirect::to('/register')->with('flash_message', 'Registration failed; please try again.')->withInput();
        }

        # Log the user in
        Auth::login($user);

        return Redirect::to('/')->with('flash_message', 'Welcome to Foobooks!');
    }

    public function login()
    {
        $credentials = Input::only('email', 'password');

        if (Auth::attempt($credentials, $remember = true)) {
            return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
        }
        else {
            return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
        }

        return Redirect::to('login');
    }

    public function logout()
    {
        # Log out
        Auth::logout();

        # Send them to the homepage
        return Redirect::to('/');
    }

}
