<!-- Left Side Of Navbar -->
<spark-navbar
:user="user"
:teams="teams"
:current-team="currentTeam"
:has-unread-notifications="hasUnreadNotifications"
:has-unread-announcements="hasUnreadAnnouncements"
inline-template>
<ul class="nav navbar-nav navbar-right parent-submenu">
	<li class="dropdown">
		<!-- User Photo / Name -->
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			 <img :src="user.photo_url" class="spark-nav-profile-photo m-r-xs">
{{-- 			<span class="caret"></span> --}}
		</a>
		<ul class="dropdown-menu my-submenu"  role="menu">
			<li class="arrow"><span>&nbsp;</span></li>

			<!-- Settings -->
			<li class="dropdown-header"></li>

			<!-- Your Settings -->
			<li>
				<a href="/settings">
					<i class="fa fa-fw fa-btn fa-cog"></i>My Profile
				</a>
			</li>

			<li class="divider"></li>

			<!-- Logout -->
			<li>
				<a href="{{ url('/logout') }}">
					<i class="fa fa-fw fa-btn fa-sign-out"></i>Logout
				</a>
			</li>
		</ul>
	</li>

</ul>
</spark-navbar>