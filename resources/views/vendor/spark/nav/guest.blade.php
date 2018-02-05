<div class="navbar navbar-fixed-top">
    <header :user="user">
        @include('spark::nav.brand')
        @if(!Request::is('onboard/*'))
        <div class="header__sign-in">
            <a title="Home" href="https://weathercheck.co/" style="line-height: 88px;">Home</a>
            <a title="About" href="https://weathercheck.co/about/" style="line-height: 88px;">About</a>
            <a title="FAQ" href="https://weathercheck.co/faq/" style="line-height: 88px;">FAQ</a>
            <a title="Contact" href="https://weathercheck.co/contact/" style="line-height: 88px;">Contact</a>
            <a href="{{ route('register') }}" class="btn btn-green">Register</a>
        <a href="/login" class="btn sign-in">Sign In</a>
    </div>
    @endif
    </header>
</div>