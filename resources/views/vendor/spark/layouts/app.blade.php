<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    @include('partials.google')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/meta/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/meta/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/meta/favicon-16x16.png">
    <link rel="manifest" href="/meta/manifest.json">
    <link rel="mask-icon" href="/meta/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="WeatherCheck">
    <meta name="application-name" content="WeatherCheck">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">

    <link href="/css/sweetalert.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/design-app.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @yield('scripts', '')
    
    <!-- Global Spark Object -->
    <script>
        window.Spark = <?php echo json_encode(array_merge(
            Spark::scriptVariables(), []
        )); ?>;
    </script>
    @include('partials.mixpanel')
</head>
<body class="{{ (Auth::check() && !Request::is('onboard/*')) ? 'with-rail-nav' : 'with-navbar' }}">
    <div id="spark-app" class="spark-app" v-cloak>
        <!-- Navigation -->


        @if (!Auth::check())
            @include('spark::nav.guest')
        @endif

        @if (Auth::check() && !Request::is('onboard/*'))
            @include('partials.rail-nav')
        @endif
        <!-- Main Content -->
        @yield('content')
        <!-- Application Level Modals -->
        @if (Auth::check())
            @include('spark::modals.notifications')
            @include('spark::modals.support')
            @include('spark::modals.session-expired')
        @endif
    </div>

    <!-- JavaScript -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="/js/sweetalert.min.js"></script>
</body>
</html>
