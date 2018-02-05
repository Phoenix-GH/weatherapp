@extends('vendor.spark.layouts.app')

@section('content')
    
    <div class="container">
        <h2>Add Property</h2>
        <form action="{{ url('property') }}" method="POST">
            {{ csrf_field() }}
            @include('partials.errors')
            <div class="form-group">
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Name of Property"
                >
            </div>
            <div class="form-group">
                <input
                    type="text"
                    name="address"
                    class="form-control"
                    placeholder="Address"
                >
            </div>
            <div class="form-group">
                <input
                    type="text"
                    name="address_2"
                    class="form-control"
                    placeholder="Address 2"
                >
            </div>

            <div class="form-group">
                <input
                    type="text"
                    name="city"
                    class="form-control"
                    placeholder="City"
                >
            </div>
            <div class="form-group">
                <input
                    type="text"
                    name="state"
                    class="form-control"
                    placeholder="State"
                >
            </div>
            <div class="form-group">
                <input
                    type="text"
                    name="country"
                    class="form-control"
                    placeholder="Country"
                >
            </div>
            <div class="form-group">
                <input
                    type="text"
                    name="zip"
                    class="form-control"
                    placeholder="Zip"
                >
            </div>
            <div class="form-group">
                <input
                    type="text"
                    name="lat"
                    class="form-control"
                    placeholder="Latitude"
                >
            </div>
            <div class="form-group">
                <input
                    type="text"
                    name="long"
                    class="form-control"
                    placeholder="Longitude"
                >
            </div>
            <div class="form-group">
                <button class="btn btn-primary">
                    Create
                </button>
            </div>

        </form>
    </div>

@stop
