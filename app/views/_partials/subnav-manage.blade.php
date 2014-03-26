	<div id="subnav-container" class="navbar navbar-default navbar-fixed-top">
		<div class="container subnav">

			<ul class="nav nav-pills pull-left">

				<li class="dropdown" id="search_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="fa fa-search"></i>
					</a>
					<ul class="dropdown-menu">
						<li>
							<ul class="dropdown-menu-list scroller">
								<li>
									<form id="subnav-search" class="form-inline" role="form">
										<div class="input-group ">
											<input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
											<div class="input-group-btn">
												<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
											</div>
										</div>
									</form>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" data-click="dropdown" data-delay="0" data-close-others="false" href="#">
						<i class="fa fa-th-large"></i> <span class="nav-text">Collections</span>
					</a>

					<ul class="dropdown-menu">
						<li><a href="/manage/collections">Collections</a></li>
						<li><a role="menuitem" data-target="#"><i class="fa fa-th-large"></i> New Collection</a></li>
					</ul>
				</li>

				<li><a href="/manage/upload"><i class="fa fa-cloud-upload"></i> <span class="nav-text">Upload</span></a></li>
				<li><a href="/manage/browse"><i class="fa fa-folder"></i> <span class="nav-text">Browse</span></a></li>
			</ul>

			<ul class="nav navbar-nav pull-right">

				<li class="dropdown" id="header_notification_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="fa fa-warning"></i>
						<span class="badge">6</span>
					</a>
					<ul class="dropdown-menu extended notification">
						<li>
							<p>You have 14 new notifications</p>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller">
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-success"><i class="icon-plus"></i></span>
										New user registered.
										<span class="time">Just now</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-danger"><i class="icon-bolt"></i></span>
										Server #12 overloaded.
										<span class="time">15 mins</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-warning"><i class="icon-bell"></i></span>
										Server #2 not responding.
										<span class="time">22 mins</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-info"><i class="icon-bullhorn"></i></span>
										Application error.
										<span class="time">40 mins</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-danger"><i class="icon-bolt"></i></span>
										Database overloaded 68%.
										<span class="time">2 hrs</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-danger"><i class="icon-bolt"></i></span>
										2 user IP blocked.
										<span class="time">5 hrs</span>
									</a>
								</li>

							</ul>
						</li>
						<li class="external">
							<a href="#">See all notifications <i class="m-icon-swapright"></i></a>
						</li>
					</ul>
				</li>
			</ul>


		</div>
	</div>
