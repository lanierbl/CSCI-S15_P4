<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- jQuery -->
    {{ HTML::script('scripts/jquery-1.11.1.min.js') }}
    <!-- Bootstrap -->
    {{ HTML::script('scripts/bootstrap.min.js') }}

    <!-- Bootstrap CSS -->
    {{ HTML::style('css/bootstrap.min.css') }}
    <!-- Site Style CSS -->
    {{ HTML::style('css/style.css') }}

    @yield('head')

</head>

<body>

    <div class="container">

        @if(Session::get('flash_message'))
            <div class='flash-message'>{{ Session::get('flash_message') }}</div>
        @endif

        @if(Auth::check())
        <a href='/logout'>Log out: {{ Auth::user()->first_name; }}</a>
        @else
        <a href='/register'>Register</a> or <a href='/login'>Log in</a>
        @endif
        <br>
        <a href='/'>Home</a>

        @yield('content')

        @yield('body')

    </div>

    @yield('scripts')

</body>

</html>