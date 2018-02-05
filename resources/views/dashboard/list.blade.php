@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Your Properties</h1>
                <section class="module-property-list">
                    <property-list></property-list>
                </section>
            </div>
        </div>
    </div>
@stop