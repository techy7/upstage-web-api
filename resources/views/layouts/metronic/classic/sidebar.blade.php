<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
	<i class="la la-close"></i>xxx
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
	<!-- BEGIN: Aside Menu -->
	<div 
		id="m_ver_menu" 
		class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
		data-menu-vertical="true"
		 data-menu-scrollable="false" data-menu-dropdown-timeout="500"  
	>
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<li class="m-menu__item @if(Request::is('home', 'home/*')) m-menu__item--active @endif" 
				aria-haspopup="true" 
			>
				<a  href="{{url('/home')}}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-line-graph"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Dashboard
							</span> 
						</span>
					</span>
				</a>
			</li>
			<li class="m-menu__item @if(Request::is('users', 'users/*')) m-menu__item--active @endif" 
				aria-haspopup="true" 
			>
				<a  href="{{url('/users')}}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-users"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Users
							</span> 
						</span>
					</span>
				</a>
			</li>
			<li class="m-menu__item @if(Request::is('listings', 'listings/*')) m-menu__item--active @endif" 
				aria-haspopup="true" 
			>
				<a  href="{{url('/listings')}}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-squares-1"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Listings
							</span> 
						</span>
					</span>
				</a>
			</li>
			<li class="m-menu__item @if(Request::is('plans', 'plans/*')) m-menu__item--active @endif" 
				aria-haspopup="true" 
			>
				<a  href="{{url('/plans')}}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-interface-8"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Plans
							</span> 
						</span>
					</span>
				</a>
			</li> 
			<li class="m-menu__item @if(Request::is('editors', 'editors/*')) m-menu__item--active @endif" 
				aria-haspopup="true" 
			>
				<a  href="{{url('/editors')}}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-user-settings"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Editors
							</span> 
						</span>
					</span>
				</a>
			</li>

			<li class="m-menu__section">
				<h4 class="m-menu__section-text">
					Others
				</h4>
				<i class="m-menu__section-icon flaticon-more-v3"></i>
			</li>
			<li class="m-menu__item @if(Request::is('apidocs', 'apidocs/*')) m-menu__item--active @endif" 
				aria-haspopup="true" 
			>
				<a  href="{{url('/apidocs')}}" class="m-menu__link ">
					<i class="m-menu__link-icon la la-code-fork" style="font-size: 27px;"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								API Docs
							</span> 
						</span>
					</span>
				</a>
			</li> 
			
		</ul>
	</div>
	<!-- END: Aside Menu -->
</div>