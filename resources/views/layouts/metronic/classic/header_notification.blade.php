@php
	$notifU = HelpNotif::unread('App\Notifications\UserNewSignup');
	$notifL = HelpNotif::unread('App\Notifications\ListingAdded');
	$notifTotal = $notifU->count() + $notifL->count();
@endphp
<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right 	m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true">
	<a href="#" class="m-nav__link m-dropdown__toggle" @if($notifTotal) id="m_topbar_notification_icon" @endif> 
		@if($notifTotal)
		<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
		@endif
		<span class="m-nav__link-icon">
			<i class="flaticon-music-2"></i>
		</span>
	</a>
	<div class="m-dropdown__wrapper">
		<span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
		<div class="m-dropdown__inner">
			<notif-header inline-template>
				<div>
					<div class="m-dropdown__header m--align-center" style="background: url({{ asset('metronic/media/img/misc/notification_bg.jpg') }}); background-size: cover;">
						<span class="m-dropdown__header-title"> 
							{{$notifTotal}}  New
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
										Listings
									</a>
								</li>
								{{--
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">
										Listings
									</a>
								</li>
								--}}
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
									@if($notifU->count())
										<div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
											<div class="m-list-timeline m-list-timeline--skin-light">
												<div class="m-list-timeline__items">
													@foreach($notifU as $userNotif)
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span> 
														<a href="{{url('/users/'.$userNotif->data['hash'])}}" 
															class="m-list-timeline__text"
														>
															<span class="text-capitalize">
																{{$userNotif->data['first_name']}}
																{{$userNotif->data['last_name']}}
															</span>
															registered
														</a>
														<span class="m-list-timeline__time w-101">
															{{$userNotif->created_at->format('M d, Y')}}
														</span>
													</div>
													@endforeach 
												</div>
											</div>
										</div>
									@else
										<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
											<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
												<div class="m-stack__item m-stack__item--center m-stack__item--middle">
													<span class="">
														All caught up!
														<br>
														No new users.
													</span>
												</div>
											</div>
										</div>
									@endif
								</div> 
								<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
									@if($notifL->count())
										<div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
											<div class="m-list-timeline m-list-timeline--skin-light"> 
												<div class="m-list-timeline__items">
													@foreach($notifL as $listingNotif)
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
														<a href="{{url('/listings/'.$listingNotif->data['hash'])}}" class="m-list-timeline__text">
															{{$listingNotif->data['name']}}
															<small class="d-block text-muted text-capitalize clearfix">
																<span class="float-right">
																	{{$listingNotif->created_at->format('M d, Y')}}
																</span>
																Added By {{$listingNotif->data['username']}}
															</small>
														</a> 
													</div> 
													@endforeach
												</div>
											</div>
										</div>
									@else
										<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
											<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
												<div class="m-stack__item m-stack__item--center m-stack__item--middle">
													<span class="">
														All caught up!
														<br>
														No new listings.
													</span>
												</div>
											</div>
										</div>
									@endif
									
								</div> 
								{{--
								<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
									<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
										<div class="m-stack__item m-stack__item--center m-stack__item--middle">
											<span class="">
												All caught up!
												<br>
												No new listings.
											</span>
										</div>
									</div>
								</div>
								--}}
							</div> 
						</div>
					</div>
				</div>
			</notif-header>
		</div>
	</div>
</li>