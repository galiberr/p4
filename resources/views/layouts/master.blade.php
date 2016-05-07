<!doctype html>
<html>
<head>
    <title>
        @yield('title', 'KJTracker')
    </title>
    <meta charset='utf-8'>
    @yield('head')
</head>
<body>
        <div class="container">
                <section>
                            {{-- Main page content --}}
                            @yield('content')
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