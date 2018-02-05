@if(Request::url() != url('/logout') )
<nav class="rail-nav">
    <a href="{{ url('dashboard') }}"
       class="icon icon-logo {{ Route::current()->getName() == 'dashboard' ? 'active' : '' }}"
       title="Logo">
        @include('icon.logo')
    </a>

    <a href="{{ url('dashboard') }}"
        class="icon icon-dashboard {{ Route::current()->getName() == 'dashboard' ? 'active' : '' }}"
        title="Dashboard">
        @include('icon.speedometer')
    </a>

    <a href="{{ url('dashboard/list') }}"
        class="icon icon-properties {{ Route::current()->getName() == 'property_dashboard' ? 'active' : '' }}"
        title="Properties">
        @include('icon.residential-block')
    </a>

    <a href="{{ url('dashboard/map') }}"
        class="icon icon-map {{ Route::current()->getName() == 'property_map' ? 'active' : '' }}"
        title="Map">
        @include('icon.map-pin')
    </a>

    <a href="{{ url('notifications/recent') }}"
        class="icon icon-notifications {{ Route::current()->getName() == 'notifications' ? 'active' : '' }}"
        title="Notifications">
        @include('icon.bell')
    </a>

    <a href="{{ url('settings') }}"
        class="icon icon-settings {{ Route::current()->getName() == 'settings' ? 'active' : '' }}"
        title="Settings">
        @include('icon.cog')
    </a>
    
    @include('spark::nav.user-left')

</nav>
@endif
