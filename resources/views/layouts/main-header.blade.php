<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="{{ url('/' . $page='home') }}"><img src="{{URL::asset('assets/img/brand/faviconn.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='home') }}"><img src="{{URL::asset('assets/img/brand/faviconn.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div>
					</div>
					<div class="main-header-right">
						
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div>
							
							

							@can('الاشعارات')
								<div class="dropdown nav-item main-header-notification">
									<a class="new nav-link" href="#">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span></a>
									<div class="dropdown-menu">
										<div class="menu-header-content bg-primary text-right">
											<div class="d-flex">
												<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الأشعارات</h6>
												<a class="badge badge-pill badge-warning mr-auto my-auto float-left"
												href="{{ route('MarkAsRead') }}">قراءة الكل</a>
											</div>
											<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
												<h6 style="color: yellow" id="notifications_count">
													{{ auth()->user()->unreadNotifications->count() }}
												</h6>
												</p>
											</div>
											<div id="unreadNotifications">
												@foreach (auth()->user()->unreadNotifications as $notification)
													<div class="main-notification-list Notification-scroll">
														<a class="d-flex p-3 border-bottom"
															href="{{ url('InvoicesDetails') }}/{{ $notification->data['id'] }}">
															<div class="notifyimg bg-pink main-img-user">
																<img src="{{URL::asset('assets/img/faces/avatar.png')}}" alt="Avatar">
															</div>
															<div class="mr-3">
																<h5 class="notification-label mb-1">{{ $notification->data['title'].$notification->data['user'] }}
																</h5>
																<div class="notification-subtext">{{ $notification->created_at }}</div>
															</div>
													</a>
													</div>
												@endforeach
											</div>
										</div>
									</div>
							@endcan
 
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/faces/avatar.png')}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/faces/avatar.png')}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{ Auth::User()->name }}</h6><span>{{ Auth::User()->email }}</span>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
									class="bx bx-log-out"></i>تسجيل خروج</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
									</form>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
