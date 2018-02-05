@extends('spark::layouts.app')

@section('content')
    <style>
        .title{
            font-size:5.5em;
        }
        .m-b-md{
            margin-top:50px;
            font-size: 4em;
        }
        .small-text{
            font-size:3.5em;
        }
    </style>
    <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <h1 class="title m-b-md text-center hidden-xs">
                    Thank you!
                </h1>
                <div class="small-text text-center m-b-md hidden-lg hidden-md hidden-sm">
                    Thank you!
                </div>
                <br>
                <br>
                <p class="lead">
                    Thank you for signing up!  We'll let you know when you can monitor the weather!
                </p>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
    </body>
    </html>

@stop