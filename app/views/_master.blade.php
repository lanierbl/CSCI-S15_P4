<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />

    @yield('head')

</head>

<body>

    @if(Session::get('flash_message'))
        <div class='flash-message'>{{ Session::get('flash_message') }}</div>
    @endif

    @if(Auth::check())
    <a href='/logout'>Log out: {{ Auth::user()->first_name; }}</a>
    @else
    <a href='/register'>Register</a> or <a href='/login'>Log in</a>
    @endif

    @yield('content')

    @yield('body')

</body>

</html>