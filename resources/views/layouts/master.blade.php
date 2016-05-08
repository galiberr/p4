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
                        <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                                <ul class="nav navbar-nav">
                                                        <li class="active"><a href="#">Edit my profile<span class="sr-only">(current)</span></a></li>
                                                        <li><a href="#">Create an event</a></li>
                                                        <li><a href="#">Find an event</a></li>
                                                        <li><a href="#">Find a user</a></li>
                                                        <li><a href="#">Look up lyrics</a></li>
                                                        <li><a href="#">Find lyrics by singing</a></li>
                                        </div>
                                </div>
                        </nav>
                        <div class="row">
                                {{-- User profile --}}
                                <div class="col-lg-12">
                                {{-- Main page content --}}
                                @yield('content')                                        
                                </div>
                        </div>
                        <section>

                        </section>
                        <footer>
                                &copy; {{ date('Y') }} &nbsp;&nbsp;
                                <a href='https://github.com/galiberr/p4' target='_blank'> View on Github</a> &nbsp;&nbsp;
                                <a href='http://p4.pyxisweb.me/' target='_blank'> View Live</a>
                        </footer>
                </div>

                @yield('body')
        </body>
</html>