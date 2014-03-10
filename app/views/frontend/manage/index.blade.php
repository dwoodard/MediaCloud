@extends('frontend/layouts/default')


@section('content')
<div id="App" ng-app="mcApp">
	<div id="main-header">
		<div id="notifications" class="">
			<div class="container">

				<ul class="nav navbar-nav pull-left">
					<li><a id="test1" href="#">test1</a></li>
					<li><a id="test2" href="#">test2</a></li>
					<li><a id="test3"  href="#">test3</a></li>
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
	</div>
	<div id="main">

		<nav id="manage_nav">
			<ul>
				<li> <a href="#"><i class="fa fa-search fa-3x"></i> <span class="nav-text">Search</span></a></li>
				<li> <a href="#"><i class="fa fa-cloud-upload  fa-3x"></i> <span class="nav-text">Upload</span></a></li>
				<li> <a href="#"><i class="fa fa-folder  fa-3x"></i> <span class="nav-text">Browse</span></a></li>
				<li> <a href="#"><i class="fa fa-th-large  fa-3x"></i> <span class="nav-text">Collections</span></a></li>
			</ul>
		</nav>
		<div id="assets_container">
			<div id="player">myvid</div>
			<p>test</p>
		</div>
		<div id="main-content">

			<section id="collections" class="hide">
				<div class="root">collections root</div>
				<div class="front">collections front</div>
			</section>

			<section id="browse" class="">
				<div class="root">
					<input type="text" ng-model="data" >

					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<h1> [[data]] </h1>
					<p>browse root</p>
					<p> [[2+4]] browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browasdfse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>broasdwse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>broasdfwse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>browse root</p>
					<p>broasdfwse root</p>
					<h1> [[data]] </h1>
				</div>
				<div class="front" data-spy="affix" data-offset-top="10" data-offset-bottom="30">
					browse front [[2+2]] [[2+2]] 
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
					<p>browse front</p>
				</div>
			</section>

		</div>

	</div>



</div>
@stop

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js"></script>
<script src="/app/app.js"></script>
<script src="/app/controllers/manageController.js"></script>


<script type="text/javascript">
	$("#test1").click(function () {
		console.log('working');
		$("#browse .front").animate({left:"100%"}, 800)
	})
	$("#test2").click(function () {
		console.log('working');
		$("#browse .front").animate({left:"20%"}, 250)
	})
</script>
@stop
