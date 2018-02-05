@extends('spark::layouts.app')

@section('content')

    <property-import-component :user='user' :current-team='currentTeam'></property-import-component>

@stop
