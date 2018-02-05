@extends('spark::layouts.app')

@section('scripts')
    <script src="https://js.stripe.com/v2/"></script>
@stop

@section('content')

    <payment-profile-component :user='user' :current-team="currentTeam"></payment-profile-component>

@stop
