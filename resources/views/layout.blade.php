<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('content')

        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/graph">Graph</a></li>
        </ul>
    </body>
</html>