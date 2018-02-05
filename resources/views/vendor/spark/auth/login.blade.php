@extends('spark::layouts.app')

@section('content')
<div class="cloud-outer">
    <div class="container">
        <div class="row">
            <div class="col-md-5 login-page">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <div class="login-heading">
                            Welcome to WeatherCheck
                        </div>
                        @include('spark::shared.errors')

                        <form class="form-horizontal" role="form" method="POST" action="/login">
                            {{ csrf_field() }}

                            <!-- E-Mail Address -->
                            <div class="form-group">

                                <div class="col-md-8 col-md-offset-2">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" autofocus>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group">

                                <div class="col-md-8 col-md-offset-2">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember">Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Login Button -->
                            <div class="form-group login-button">
                                <div class="col-md-5 float-unset">
                                    <button type="submit" class="btn btn-green">
                                        Login
                                    </button>
                                </div>
                            </div>

                            <!-- Forgot Password -->
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <a class="btn-link" href="{{ url('/password/reset') }}">Forgot Password?</a>
                                    <a class="btn-link pull-right" href="{{ route('register') }}">Create an Account</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
