<!doctype html>
<html>
        <head>
                <title>
                        @yield('title', 'KaraokeTracker')
                </title>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <link href='/css/bootstrap.css' rel='stylesheet'>
                <link href='/css/styles.css' rel='stylesheet'>
                @yield('head')
        </head>
        <body>
                <div class="container">
                        {{-- Main banner --}}
                        <div class="jumbotron">
                                <h1>KaraokeTracker</h1>
                                <p>Find karaoke events in your area.</p>
                        </div>
                        {{-- Login status/registration --}}
                        <div class="row">
                                <div class="col-lg-9">
                                        <p class="text-danger">
                                        @if(Session::get('flash_message') != null)
                                            {{ Session::get('flash_message') }}
                                        @endif
                                        </p>
                                </div>
                                <div class="col-lg-3">
                                        <p class="text-primary">
                                        @if(Auth::check())
                                        Welcome, {{ Auth::user()->user_name }}! <a href="/logout">Logout</a>
                                        @else
                                        <a href="/login">Login</a>  Not a user? <a href="/register">Register</a>
                                        @endif
                                        </p>
                                </div>
                        </div>
                        <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                                <ul class="nav navbar-nav">
                                                        @yield('navbar')
                                                </ul>
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