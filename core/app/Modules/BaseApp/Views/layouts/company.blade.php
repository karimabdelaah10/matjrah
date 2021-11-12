<!DOCTYPE html>
<html lang="en" dir="en">

    <head>
        @include('BaseApp::partials.meta')
        @include('BaseApp::partials.css') @stack('css')
    </head>

    <body>
        @include('BaseApp::partials.header')
        <!-- slim-header -->
{{--        @include('BaseApp::partials.navigation')--}}
        <!-- slim-navbar -->
        <div class="slim-mainpanel">
            <div class="container">
                @include('BaseApp::partials.breadcrumb')
                @include('BaseApp::partials.flash_messages')
                <!-- section-wrapper -->
                @yield('content')
                <!-- section-wrapper -->
            </div>
            <!-- container -->
        </div>
        <!-- slim-mainpanel -->
        <!-- slim-footer -->
        @include('BaseApp::partials.footer')
        @include('BaseApp::partials.js')
        @stack('js')
    </body>

</html>
