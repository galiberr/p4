<!doctype html>
<html>
        <head>
                <title>
                        @yield('title', 'KaraokeTracker')
                </title>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <link href='/css/cerulean/bootstrap.css' rel='stylesheet'>
                <link href='/css/cerulean/bootstrap.min.css' rel='stylesheet'>
                @yield('head')
        </head>
        <body>
                <div class="container">
                        <div class="jumbotron">
                                <h1>KaraokeTracker</h1>
                                <p>Find karaoke events in your area.</p>
                        </div>
                        <div class="row">

                                {{-- Left navigation bar --}}
                                <div class="col-lg-2">
                                        <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                        <h3 class="panel-title">Left navbar</h3>
                                                </div>
                                                <div class="panel-body">
                                                        <div class="list-group table-of-contents">
                                                                <a class="list-group-item" href="">Edit my profile</a>
                                                                <a class="list-group-item" href="">Create an event</a>
                                                                <a class="list-group-item" href="">Find an event</a>
                                                                <a class="list-group-item" href="">Find a user</a>
                                                                <a class="list-group-item" href="">Look up lyrics</a>
                                                                <a class="list-group-item" href="">Find lyrics by singing</a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                {{-- User profile --}}
                                <div class="col-lg-10">
                                {{-- Main page content --}}
                                @yield('content')
                                </div>
                        </div>
                        <footer>
                                &copy; {{ date('Y') }} &nbsp;&nbsp;
                                <a href='https://github.com/galiberr/p4' target='_blank'> View on Github</a> &nbsp;&nbsp;
                                <a href='http://p4.pyxisweb.me/' target='_blank'> View Live</a>
                        </footer>
                </div>

                @yield('body')
        </body>
</html>