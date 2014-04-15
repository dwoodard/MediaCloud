
<div id="subnav-container" class="navbar navbar-default navbar-fixed-top">
	<div class="container subnav">

		<ul class="nav nav-pills pull-left">

			<li class="dropdown keep-open" id="search_bar">
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


			<li class="dropdown keep-open">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-cloud-upload"></i> <span class="nav-text">Upload</span>
				</a>
				<ul class="dropdown-menu" id="upload-dropdown">
					<li>
						<ul class="dropdown-menu-list scroller">
							<li>
								<div id="uploads-area" class="">
									<form id="filedrop" method="post" action="/manage/upload" class="dropzone" enctype="multipart/form-data">
										<input id="userId" type="hidden" value="{{Sentry::getUser()->id}}">
										<div class="fallback">
											<input name="files[]" type="file" multiple=""/>
										</div>
									</form>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>

			<li>
				<a id="subnav-btn-collections"  href="#">
					<i class="fa fa-th-large"></i> <span class="nav-text">Collections</span>
				</a>
			</li>
			<li>
				<a id="subnav-btn-assets" href="#"><i class="fa fa-play-circle"></i> <span class="nav-text">Player</span></a>
			</li>
			<li>
				<a id="subnav-btn-browse" href="#"><i class="fa fa-folder"></i> <span class="nav-text">Browse</span></a>
			</li>
			<li>
				<a id="subnav-btn-browse" href="#"><i class="fa fa-camera"></i> <span class="nav-text">Capture</span></a>
			</li>
		</ul>

		<ul class="nav navbar-nav pull-right">

			<li class="dropdown keep-open" id="header_notification_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-warning"></i>
					@if(count($unassignedAssets))
					<span class="badge">{{count($unassignedAssets)}}</span>
					@endif
				</a>
				<ul class="dropdown-menu extended notification">
					<li>
						<p>You have {{count($unassignedAssets)}} Unassigned Assets</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" >

							@foreach ($unassignedAssets as $asset)
							<li data-asset-id="{{$asset->id}}">
								<a class="draggable-asset" href="#" >
									<i class="fa fa-ellipsis-v "></i>
									<span class="label label-sm label-icon label-success">
										@if ($asset->type === 'video')
										<i class="fa fa-video-camera"></i>
										@elseif ($asset->type === 'audio')
										<i class="fa fa-microphone"></i>
										@else
										<i class="fa fa-picture-o"></i>
										@endif

										{{ $asset->title }}


									</span>
								</a>
								<div class="pull-right">
									<a href="#" class="asset-player-btn"><i class="fa fa-play-circle"></i></a>
									<a href="#" class=""><i class="fa fa-ellipsis-h"></i></a>
								</div>


							</li>
							@endforeach



						</ul>
					</li>

				</ul>
			</li>
		</ul>

	</div>
</div>