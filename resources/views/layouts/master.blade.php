<!DOCTYPE html>
<html>
    <head>
        @include('layouts.header')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @yield('extended_css')

            @include('layouts.menu')

            @include('layouts.sidebar')

            @yield('content')

            @include('layouts.footer')
        </div>

        @include('layouts.footer_js')
        @yield('extended_js')
        @yield('inlineScripts')
    </body>

</html>