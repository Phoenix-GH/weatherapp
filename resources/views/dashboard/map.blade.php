@extends('spark::layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <property-list></property-list>
        </div>
        <div class="col-sm-12 col-md-9" >
            @include('partials.map',['size' => 900])
        </div>
    </div>
@stop