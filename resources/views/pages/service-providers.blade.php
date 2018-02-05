<!doctype html>
<html>
<head>
    <title>Welcome to WeatherCheck!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="{{ mix('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/components/services/service-providers.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <header>
            <div class="logo-wc"></div>
                <div class="header__sign-in">
                    <a href="/onboard/1/register" class="btn sign-in">Register</a>
                    <a href="#" class="btn sign-in">Sign In</a>
                </div>
            </header>
        </div>
    </div>

    <div class="container-fluid">
        <h1>Find Service Providers</h1>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form">
                            <div class="col-sm-4">
                                <label class="sr-only" for="search-by-location">Search by City, State, or Zip</label>
                                <input type="text" class="form-control" id="search-by-location" placeholder="Search by City, State, or Zip">
                            </div>

                            <div class="col-sm-4">
                                <label>
                                    <select class="form-control">
                                        <option>Filter by service</option>
                                        <option>Service 1</option>
                                        <option>Service 2</option>
                                    </select>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-search pull-right">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="module-service-providers panel">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="service-provider panel-body">
                            <img src="http://via.placeholder.com/90x90" alt="" class="logo">

                            <div class="info">
                                <div class="company-name">American Roofing and Metal</div>
                                <div class="service">Service: <span class="value">Roofing</span></div>
                                <div class="phone">Phone: <span class="value">502-966-2900</span></div>
                                <div class="address">Address: <span class="value">4610  Roofing Rd, Louisville, KY 40218</span></div>
                            </div>

                            <button class="btn btn-primary">Visit Site</button>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</body>
</html>
