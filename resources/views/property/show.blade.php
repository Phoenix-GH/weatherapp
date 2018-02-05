@extends('spark::layouts.app')

@section('content')
        <div class="container-fluid single-address-map">
            <div class="row">
                @include('partials.map',['size' => 400])
            </div>
            <div class="row">
                <section class="module-map-address" style="background-color: white; z-index: 9999;">
                    <h3 class="text-center">
                        {{ $property->address }} {{ $property->city }}, {{ $property->state }} {{ $property->zip }}
                    </h3>
                </section>
            </div>
            <div class="row m-t-25">
                <section class="module-newsletter insurance-outrbox-txt col-xs-12 col-sm-4">
                    <div class="form-wrapper">
                        <div class="title">This is just a taste of the new WeatherCheck</div>
                        <div>The new full version will be unveiled soon. Be the first to find out.</div>
                        <form role="form" action="{{ url('store_lead') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" placeholder="First Name" name="first_name">
                            <input type="text" placeholder="Last Name" name="last_name">
                            <input type="text" placeholder="Email" name="email">
                            <input class="btn x1" type="submit" name="submit" value="Keep Me Posted">
                        </form>
                    </div>
                </section>
                <section class="col-xs-12 col-sm-8">
{{--                     <div class="module-property-list"> --}}
                        <weather-events :property="{{ $property }}"></weather-events>
             {{--        </div>
 --}}                </section>
            </div>
            <div class="row m-t-25">
                <section class="col-xs-12">
                    <h2>Legal Disclaimers</h2>
                    <p class="text-left">
                        Information provided by WeatherCheck and its Affiliates does not represent legal interpretation,
                        guidance, home inspection or advice of WeatherCheck. While efforts have been made to ensure accuracy,
                        this presentation is not a substitute for formal adjusting. These representations do not bind
                        WeatherCheck or its affiliates and does not create any rights, benefits, or defenses, substantive
                        or procedural, that are enforceable by any party in any manner.
                    </p>
                </section>
            </div>
        </div>
        <div id="footer" class="container-fluid m-t-50 footer-background">
            <div class="row">
                <div class="pull-left m-l-50">
                    <a title="Home" href="https://weathercheck.co/" style="padding-right: 30px;line-height: 88px;">Home</a>
                    <a title="About" href="https://weathercheck.co/about/" style="padding-right: 30px;line-height: 88px;">About</a>
                    <a title="FAQ" href="https://weathercheck.co/faq/" style="padding-right: 30px;line-height: 88px;">FAQ</a>
                    <a title="Contact" href="https://weathercheck.co/contact/" style="padding-right: 30px;line-height: 88px;">Contact</a>
                </div>
                <div class="pull-right m-r-50">
                    <a title="Contact" href="#" style="line-height: 88px;">@2018 WeatherCheck</a>
                </div>
            </div>
        </div>
@stop
