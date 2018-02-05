<!doctype html>
<html>
<head>
    <title>Onboarding - Import</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <link href="{{ mix('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ mix('css/bootstrap-theme.css') }}" rel="stylesheet">
    <link href="{{ mix('css/onboard-fonts.css') }}" rel="stylesheet">
    <link href="{{ mix('css/onboard.css') }}" rel="stylesheet">

    <script>
        window.Spark = <?php echo json_encode(array_merge(
			Spark::scriptVariables(), []
		)); ?>;
    </script>

</head>
<body class="bg-clouds">
<div class="container-fluid">
    <!-- Main Content -->
    @yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>