<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/semantic-ui@2.4.1/dist/semantic.min.css"/>
    </head>
    <body>
        
        <div class="ui attached stackable menu">
        <div class="ui container">
            <a class="item" href="/">
                <i class="home icon"></i> Home
            </a>
            <a class="item" href="/graph">
                <i class="chart bar icon"></i> Graph
            </a>
        </div>
    </div>

        @yield('content')

    </body>
</html>