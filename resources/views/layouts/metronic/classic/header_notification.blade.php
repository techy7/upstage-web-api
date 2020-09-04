<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right 	m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true">
	<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
		<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
		<span class="m-nav__link-icon">
			<i class="flaticon-music-2"></i>
		</span>
	</a>
	<div class="m-dropdown__wrapper">
		<span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
		<div class="m-dropdown__inner">
			<notifications inline-template>
			<div class="m-dropdown__header m--align-center" style="background: url({{ asset('metronic/media/img/misc/notification_bg.jpg') }}); background-size: cover;">
				<span class="m-dropdown__header-title">
					@{{totalNotifs}} New
				</span>
				<span class="m-dropdown__header-subtitle">
					All Notifications
				</span>
			</div>
			<div class="m-dropdown__body">
				<div class="m-dropdown__content"> 
					<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
								Users
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">
								Events
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">
								Logs
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
							<div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
								<div class="m-list-timeline m-list-timeline--skin-light">
									<div class="m-list-timeline__items">
										<div class="m-list-timeline__item">
											<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
											<a href="#" class="m-list-timeline__text">
												12 new users registered
											</a>
											<span class="m-list-timeline__time">
												Just now
											</span>
										</div>
										 
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
							<div class="m-scrollable" m-scrollabledata-scrollable="true" data-max-height="250" data-mobile-max-height="200">
								<div class="m-list-timeline m-list-timeline--skin-light">
									<div class="m-list-timeline__items">
										<div class="m-list-timeline__item">
											<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
											<a href="" class="m-list-timeline__text">
												New order received
											</a>
											<span class="m-list-timeline__time">
												Just now
											</span>
										</div> 
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
							<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
								<div class="m-stack__item m-stack__item--center m-stack__item--middle">
									<span class="">
										All caught up!
										<br>
										No new logs.
									</span>
								</div>
							</div>
						</div>
					</div> 
				</div>
			</div>
			</notifications>
		</div>
	</div>
</li>