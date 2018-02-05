@extends('spark::layouts.app')

@section('content')
<div class="container mt-1 mb-1">
    <div class="row" style="">
        @include('partials.map',['size' => 400])
    </div>
    <div class="row">
        <section class="module-map-address" style="background-color: white; z-index: 9999;">
            <h3 class="text-center">
                {{ $property->address }}
            </h3>
        </section>
    </div>
    <div class="row">
        <section class="col-xs-12 col-md-3 col">
            <notification-settings></notification-settings>
        </section>
        <section class="col-xs-12 col-md-8 col">
            <weather-events :property="{{ $property }}"></weather-events>
        </section>
    </div>
    <div class="row">
        <section class="col-xs-12 col-md-8 col">
            <maintenance-checklist></maintenance-checklist>
        </section>
        <section class="col-xs-12 col-md-3 col">
            <property-insurance></property-insurance>
        </section>
    </div>
    <div class="row">
        <section class="col-xs-12">
            <h2>Legal Disclaimers</h2>
            <div class="align-right">Information provided by WeatherCheck and its Affiliates does not represent legal interpretation, guidance, home inspection or advice of WeatherCheck. While efforts have been made to ensure accuracy, this presentation is not a substitute for formal adjusting. These representations do not bind WeatherCheck or its affiliates and does not create any rights, benefits, or defenses, substantive or procedural, that are enforceable by any party in any manner.</div>
        </section>
    </div>
</div>
@stop
@section('scripts')
    {!! Mapper::renderJavascript() !!}
@stop