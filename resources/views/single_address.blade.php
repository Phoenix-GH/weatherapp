@extends('spark::layouts.app')

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('google-geocoder.applicationKey') }}&libraries=places"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        @if ( count( $errors ) > 0 )
            @foreach ($errors as $error)
                <div class="alert alert-danger alert-dismissable">
                    <ul>
                        <li> {{ $error }}</li>
                    </ul>
                </div>
            @endforeach
        @endif
        <section class="side-wrapper two-col">
            <div class="side-wrapper__left">
                <img src="../images/laptop-book-pro-dash.png" class="image-hero">
            </div>
            <div class="side-wrapper__right">
                <div class="form-wrapper">
                    <div class="logo-wc form"></div>
                    <p>
                        See WeatherCheck in action.<br/>
                        Check a Single property.
                    </p>
                    <form role="form" action="{{ url('single_check_address') }}" method="POST">
                        {{ csrf_field() }}
                        <vue-google-autocomplete
                                :country="['us']"
                                id="map"
                                className="form-control"
                                placeholder="Full Address"
                                name="address"
                        ></vue-google-autocomplete>

                        <input class="btn " type="submit" name="submit" value="Check">
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
