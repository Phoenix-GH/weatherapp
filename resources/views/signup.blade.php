@extends('spark::layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
            <header>
            <div class="logo-wc"></div>
            <div class="header__sign-in">
                <a href="/onboard/1/register" class="btn sign-in">Register</a>
                <a href="#" class="btn sign-in">Sign In</a>
            </div>
        </header>
    </div>
    <div class="row">
        <section class="side-wrapper two-col">
            <div class="side-wrapper__left">
                <img src="../images/laptop-book-pro-dash.png" class="image-hero">
            </div>
            <div class="side-wrapper__right">
                <div class="form-wrapper sign-up">
                    <div class="logo-wc form"></div>
                    <p>The new WeatherCheck will be unveiled soon. Be the first to find out. </p>
                    <form role="form" action="{{ url('store_lead') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" placeholder="First Name" name="first_name">
                        <input type="text" placeholder="Last Name" name="last_name">
                        <input type="text" placeholder="Email" name="email">
                        <input class="btn x1" type="submit" name="submit" value="Keep Me Posted">
                        <p>Existing Customer?</p>
                        <div class="form-wrapper__sign-in">
                            <submit class="btn sign-in">Sign In</submit>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
