@extends('spark::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <!-- Begin property rating -->
            <!-- The "pXX" class ("p78" below) determines the fill percentage. -->
            <div class="property-rating c100 p78 big">
                <div class="info">
                    <span class="icon"></span>
                    <span class="percentage">78%</span>
                    <span class="label">of your properties are in good shape</span>
                </div>
                <div class="slice"><div class="bar"></div><div class="fill"></div></div>
            </div>
            <!-- End property rating -->
        </div>
        <div class="col-sm-12 col-md-9">
            <weather-events></weather-events>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="module-property-list">
                <property-list></property-list>
            </section>
        </div>
    </div>
</div>
@stop
