<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        @include('BaseApp::partials.meta')
        @include('BaseApp::partials.css') @stack('css')
    </head>

    <body>
        <div class="slim-mainpanel mg-t-40">
            <div class="container">

                @yield('content')
                <!-- section-wrapper -->

            </div>
            <!-- container -->
        </div>
        <!-- slim-mainpanel -->


        <!-- slim-footer -->
        @include('BaseApp::partials.js') @stack('js')
    </body>

</html>
