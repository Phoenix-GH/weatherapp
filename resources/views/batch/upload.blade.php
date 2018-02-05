@extends('vendor.spark.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Batch Upload
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('property/batch') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('partials.errors')
                        <div class="form-group">
                            <input type="file" name="csv">
                        </div>
                        <div class="form-group">
                            <button
                                class="btn btn-primary"
                                type="submit"
                            >
                                Submit
                            </button>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
