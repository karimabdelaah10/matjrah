<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        @include('BaseApp::partials.meta')
        @include('BaseApp::partials.css') @stack('css')
    </head>

    <body>

    <div class="page-error-wrapper">
      <div>

          @yield('content')
        <p class="mg-b-50"><a href="javascript:history.go(-1)" class="btn btn-error">{{ trans('app.Back To Home')}}</a></p>
        <p class="error-footer">
      </div>

    </div><!-- page-error-wrapper -->



        <!-- slim-footer -->
        @include('BaseApp::partials.js') @stack('js')
    </body>

</html>
