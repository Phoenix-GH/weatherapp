@extends('spark::layouts.app')

<!-- Main Content -->
@section('content')
<div class="cloud-outer">
    <div class="container">
        <div class="row">
            @if (session('status'))
            <reset-password></reset-password>
             @else
            <div class="col-md-5 login-page forgot-password">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="login-heading">
                            Forgot Password?
                        </div>
                        {{-- @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif --}}
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                            {!! csrf_field() !!}

                            <!-- E-Mail Address -->
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-8 col-md-offset-2 control-label">Enter your email address to reset your password. You may need to check your spam folder or unblock no-reply@weathercheck.co.</label>

                                <div class="col-md-8 col-md-offset-2">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus placeholder="Email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Send Password Reset Link Button -->
                            <div class="form-group login-button">
                                <div class="col-md-5 float-unset">
                                    <button type="submit" class="btn btn-green">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
