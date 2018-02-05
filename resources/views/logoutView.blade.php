@extends('spark::layouts.app')

<!-- Main Content -->
@section('content')
<div class="cloud-outer">
    <div class="container">
        <div class="row">
            <div class="col-md-5 login-page forgot-password">
                <div class="panel panel-default">

                    <div class="panel-body">
                        
                        <div class="login-heading">
                            You've been successfully logged out
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<logout-redirect></logout-redirect>
@endsection
