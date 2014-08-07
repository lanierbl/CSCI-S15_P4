<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @yield('head')

</head>

<body>

    @if(Session::get('flash_message'))
        <div class="text-center alert alert-{{Session::get('flash_type')}} flash" role="alert">
            {{ Session::get('flash_message') }}
        </div>
    @endif

    @yield('content')

    @yield('body')

    <!-- jQuery -->
    {{ HTML::script('scripts/jquery-1.11.1.min.js') }}
    <!-- Bootstrap -->
    {{ HTML::script('scripts/bootstrap.min.js') }}

    @yield('scripts')


</body>

</html>