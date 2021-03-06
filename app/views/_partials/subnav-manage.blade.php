
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


			<!--<li class="dropdown keep-open">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-cloud-upload"></i> <span class="nav-text">Upload</span>
				</a>
				<ul class="dropdown-menu" id="upload-dropdown">
					@if (Sentry::getUser()->hasAccess('tos'))
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
					@else
					<li>
						<ul class="dropdown-menu-list scroller">
							<li>
								<div id="uploads-area" class="">
									<form class="form-horizontal" action="v1/user/tos" method="POST">
										<fieldset>
											<div class="form-group">
												<label class="col-md-4 control-label" for="tos">Terms of services</label>
												<div class="col-md-7">
													<label class="checkbox-inline" for="tos-0">
														<input type="hidden" name="user_id" id="user_id" value="{{Sentry::getUser()->id}}">
														<input type="checkbox" name="tos" id="tos-0" value="1">
														I will <strong>not upload copyrighted</strong> material
													</label>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-4 control-label"></label>
												<div class="col-md-4">
													<button type="submit" class="btn btn-success">I Agree</button>
												</div>
											</div>

										</fieldset>
									</form>

								</div>
							</li>
						</ul>
					</li>

					@endif


				</ul>
			</li>-->

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
<!--            <li>-->
<!--                <a id="subnav-btn-capture" href="#"><i class="fa fa-camera"></i> <span class="nav-text">Capture</span></a>-->
<!--            </li>-->

                <li class="dropdown keep-open">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                         <i class="fa fa-camera"></i>  <span class="nav-text">Capture</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="subnav-btn-capture" href="#"><i class="fa fa-camera"></i> <span class="nav-text">Screen Capture (Java Applet)</span></a></li>
                        <li><a href="/manage/schedule-capture"><i class="fa fa-calendar"></i> <span class="nav-text">Schedule Capture (Extron)</span></a></li>
                    </ul>

                </li>


			<li>
				<a id="subnav-btn-files" href="/manage/files"><i class="fa fa-files-o"></i> <span class="nav-text">Files</span></a>
			</li>
		</ul>

		<ul class="nav navbar-nav pull-right">

			<li class="dropdown keep-open" id="unassigned_assets_notify">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-warning"></i>
					@if(count($unassignedAssets))
					<span class="unassigned_assets_count badge">{{count($unassignedAssets)}}</span>
					@endif
				</a>
				<ul class="dropdown-menu extended notification" id="unassigned-assets-list">
					<li>
						<p>You have <span class="unassigned_assets_count">{{count($unassignedAssets)}}</span> Unassigned Assets</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" >

							@foreach ($unassignedAssets as $asset)
							<li data-asset-id="{{$asset->id}}">
								<a class="draggable-asset" href="#" >

									<span class="label label-sm label-icon label-success">
										@if ($asset->type === 'video')
										<i class="fa fa-video-camera"></i>
										@elseif ($asset->type === 'audio')
										<i class="fa fa-microphone"></i>
										@else
										<i class="fa fa-picture-o"></i>
										@endif

										{{ Str::limit($asset->title, 25 ) }}


									</span>
								</a>
								<div class="pull-right">
									@if($asset->status == "transcoded:complete")
									<a class="asset-player-btn" href="#"><i class="fa fa-play-circle-o"></i></a>
									@else
									<i class="fa fa-clock-o spin"></i>
									@endif
								</div>


							</li>
							@endforeach



						</ul>
					</li>

				</ul>
			</li>
		</ul>

	</div>

	<div id="progress-bar-container">
		<div class="progress-bar-status"></div>
	</div>

</div>
