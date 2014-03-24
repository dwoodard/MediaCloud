@extends('frontend/layouts/manage')


@section('content')
<div ng-app="mcApp">

	<div id="subnav-container">
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

				<li><a href="#collections"><i class="fa fa-th-large"></i> <span class="nav-text">Collections</span></a></li>
				<li><a href="#upload"><i class="fa fa-cloud-upload"></i> <span class="nav-text">Upload</span></a></li>
				<li><a href="#browse"><i class="fa fa-folder"></i> <span class="nav-text">Browse</span></a></li>
			</ul>


			<ul class="nav navbar-nav pull-right">


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



	<div id="main">

		<div class="app-folders-container" style="margin-top: 0px;">
			<div class="jaf-row jaf-container">
				<div class="folder" id="okcomputer" style="opacity: 1;">
					<a href="#">
						<i class="fa fa-search"></i>
						<p class="album-name">OK Computer</p>
						<p class="artist-name">Radiohead</p>
					</a>
				</div>
				<div class="folder" id="intheaeroplane" style="opacity: 1;">
					<a href="#">
						<i class="fa fa-search"></i>
						<p class="album-name">In the Aeroplane Over the Sea</p>
						<p class="artist-name">Neutral Milk Hotel</p>
					</a>
				</div>
				<div class="folder" id="yankeehotelfoxtrot" style="opacity: 1;">
					<a href="#">
						<i class="fa fa-search"></i>
						<p class="album-name">Yankee Hotel Foxtrot</p>
						<p class="artist-name">Wilco</p>
					</a>
				</div>
				<div class="folder" id="sophtwareslump" style="opacity: 1;">
					<a href="#">
						<i class="fa fa-search"></i>
						<p class="album-name">The Sophtware Slump</p>
						<p class="artist-name">Grandaddy</p>
					</a>
				</div>
				<br class="clear">
			</div><div class="folderContent sophtwareslump" style="display: none; background-color: rgb(146, 163, 177);">
			<div class="jaf-container">
				<div>
					<div class="art-wrap" style="box-shadow: rgb(146, 163, 177) 12px 15px 20px inset, rgb(146, 163, 177) -1px -1px 150px inset;">
				<i class="fa fa-search"></i>
					</div>
					<h2><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">The Sophtware Slump</a></h2>
					<h3 class="secondaryColor" style="color: rgb(0, 0, 0);">Grandaddy (2000)</h3>
					<div class="multi">
						<ol class="secondaryColor" style="color: rgb(0, 0, 0);">
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">He's Simple, He's Dumb, He's the Pilot</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">Hewlett's Daughter</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">Jed the Humanoid</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">The Crystal Lake</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">Chartsengrafs</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">Underneath the Weeping Willow</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">Broken Household Appliance National Forest</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">Jed's Other Poem (Beautiful Ground)</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">E. Knievel Interlude (The Perils of Keeping It Real)</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">Miner at the Dial-A-View</a></li>
							<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.318902893&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fthe-sophtware-slump%2Fid318902893%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(0, 0, 0);">So You'll Aim Toward the Sky</a></li>
						</ol>
					</div>
				</div>
				<br class="clear">
			</div>
			<a href="#" class="close">×</a>
		</div><div class="folderContent yankeehotelfoxtrot" style="display: none; background-color: rgb(195, 179, 147);">
		<div class="jaf-container">
			<div>
				<div class="art-wrap" style="box-shadow: rgb(195, 179, 147) 12px 15px 20px inset, rgb(195, 179, 147) -1px -1px 150px inset;">
				<i class="fa fa-search"></i>
				</div>
				<h2><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">Yankee Hotel Foxtrot</a></h2>
				<h3 class="secondaryColor" style="color: rgb(100, 84, 68);">Wilco (2002)</h3>
				<div class="multi">
					<ol class="secondaryColor" style="color: rgb(100, 84, 68);">
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">I Am Trying to Break Your Heart</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">Kamera</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">Radio Cure</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">War on War</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">Jesus, Etc.</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">Ashes of American Flags</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">Heavy Metal Drummer</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">I'm the Man Who Loves You</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">Pot Kettle Black</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">Poor Places</a></li>
						<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.300981120&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyankee-hotel-foxtrot%2Fid300981120%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(52, 47, 37);">Reservations</a></li>
					</ol>
				</div>
			</div>
			<br class="clear">
		</div>
		<a href="#" class="close">×</a>
	</div><div class="folderContent intheaeroplane" style="display: none; background-color: rgb(179, 185, 146);">
	<div class="jaf-container">
		<div>
			<div class="art-wrap" style="box-shadow: rgb(179, 185, 146) 12px 15px 20px inset, rgb(179, 185, 146) -1px -1px 150px inset;">
				<i class="fa fa-search"></i>
			</div>
			<h2><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">In the Aeroplane Over the Sea</a></h2>
			<h3 class="secondaryColor" style="color: rgb(0, 0, 0);">Neutral Milk Hotel (1998)</h3>
			<div class="multi">
				<ol class="secondaryColor" style="color: rgb(0, 0, 0);">
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">The King of Carrot Flowers Pt. One</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">The King of Carrot Flowers Pts. Two &amp; Three</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">In the Aeroplane Over the Sea</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">Two-Headed Boy</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">The Fool</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">Holland, 1945</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">Communist Daughter</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">Oh Comely</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">Ghost</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">*</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.5611612&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fin-the-aeroplane-over-the-sea%2Fid5611612%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(94, 54, 30);">Two-Headed Boy Pt. Two</a></li>
				</ol>
			</div>
		</div>
		<br class="clear">
	</div>
	<a href="#" class="close">×</a>
</div><div class="folderContent okcomputer" style="display: none; background-color: rgb(224, 232, 233);">
<div class="jaf-container">
	<div>
		<div class="art-wrap" style="box-shadow: rgb(224, 232, 233) 12px 15px 20px inset, rgb(224, 232, 233) -1px -1px 150px inset;">
				<i class="fa fa-search"></i>
		</div>
		<h2><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">OK Computer</a></h2>
		<h3 class="secondaryColor" style="color: rgb(117, 93, 98);">Radiohead (1997)</h3>
		<div class="multi">
			<ol class="secondaryColor" style="color: rgb(117, 93, 98);">
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Airbag</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Paranoid Android</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Subterranean Homesick Alien</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Exit Music (For a Film)</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Let Down</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Karma Police</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Fitter Happier</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Electioneering</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Climbing Up the Walls</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">No Surprises</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">Lucky</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.18421725&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fok-computer%2Fid18421725%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(59, 81, 93);">The Tourist</a></li>
			</ol>
		</div>
	</div>
	<br class="clear">
</div>
<a href="#" class="close">×</a>
</div>
<div class="jaf-row jaf-container">
	<div class="folder" id="originofsymmetry" style="opacity: 1;">
		<a href="#">
			<i class="fa fa-search"></i>
			<p class="album-name">Origin of Symmetry</p>
			<p class="artist-name">Muse</p>
		</a>
	</div>
	<div class="folder" id="yoshimibattlesthepinkrobots" style="opacity: 1;">
		<a href="#">
			<i class="fa fa-search"></i>
			<p class="album-name">Yoshimi Battles the Pink Robots</p>
			<p class="artist-name">The Flaming Lips</p>
		</a>
	</div>
	<div class="folder" id="kida" style="opacity: 1;">
		<a href="#">
			<i class="fa fa-search"></i>
			<p class="album-name">Kid A</p>
			<p class="artist-name">Radiohead</p>
		</a>
	</div>
	<div class="folder" id="agaetisbyrjun" style="opacity: 1;">
		<a href="#">
			<i class="fa fa-search"></i>
			<p class="album-name">Ágætis byrjun</p>
			<p class="artist-name">Sigur Rós</p>
		</a>
	</div>
	<br class="clear">
</div><div class="folderContent kida" style="display: none; background-color: rgb(9, 8, 9);">
<div class="jaf-container">
	<div>
		<div class="art-wrap" style="box-shadow: rgb(9, 8, 9) 12px 15px 20px inset, rgb(9, 8, 9) -1px -1px 150px inset;">
				<i class="fa fa-search"></i>
		</div>
		<h2><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">Kid A</a></h2>
		<h3 class="secondaryColor" style="color: rgb(106, 120, 134);">Radiohead (2000)</h3>
		<div class="multi">
			<ol class="secondaryColor" style="color: rgb(106, 120, 134);">
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">Everything in its Right Place</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">Kid A</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">The National Anthem</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">How to Disappear Completely</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">Treefingers</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">Optimistic</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">In Limbo</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">Idioteque</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">Morning Bell</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.280438123&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fkid-a%2Fid280438123%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(198, 202, 198);">Motion Picture Soundtrack</a></li>
			</ol>
		</div>
	</div>
	<br class="clear">
</div>
<a href="#" class="close">×</a>
</div><div class="folderContent yoshimibattlesthepinkrobots" style="display: none; background-color: rgb(235, 212, 139);">
<div class="jaf-container">
	<div>
		<div class="art-wrap" style="box-shadow: rgb(235, 212, 139) 12px 15px 20px inset, rgb(235, 212, 139) -1px -1px 150px inset;">
				<i class="fa fa-search"></i>
		</div>
		<h2><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">Yoshimi Battles the Pink Robots</a></h2>
		<h3 class="secondaryColor" style="color: rgb(115, 130, 92);">The Flaming Lips (2002)</h3>
		<div class="multi">
			<ol class="secondaryColor" style="color: rgb(115, 130, 92);">
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">Fight Test</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">One More Robot/Sympathy 3000-21</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">Yoshimi Battles the Pink Robots Part 1</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">Yoshimi Battles the Pink Robots Part 2</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">In the Morning of the Magicians</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">Ego Tripping at the Gates of Hell</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">Are You a Hypnotist??</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">It's Summertime</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">Do You Realize??</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">All We Have is Now</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.145124351&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fyoshimi-battles-pink-robots%2Fid145124351%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(190, 62, 45);">Approaching Pavonis Mons by Balloon (Utopia Planitia)</a></li>
			</ol>
		</div>
	</div>
	<br class="clear">
</div>
<a href="#" class="close">×</a>
</div><div class="folderContent originofsymmetry" style="display: none; background-color: rgb(247, 152, 48);">
<div class="jaf-container">
	<div>
		<div class="art-wrap" style="box-shadow: rgb(247, 152, 48) 12px 15px 20px inset, rgb(247, 152, 48) -1px -1px 150px inset;">
				<i class="fa fa-search"></i>
		</div>
		<h2><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Origin of Symmetry</a></h2>
		<h3 class="secondaryColor" style="color: rgb(0, 0, 0);">Muse (2005)</h3>
		<div class="multi">
			<ol class="secondaryColor" style="color: rgb(0, 0, 0);">
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">New Born</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Bliss</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Space Dementia</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Hyper Music</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Plug In Baby</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Citizen Erased</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Micro Cuts</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Screenager</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Dark Shines</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Feeling Good</a></li>
				<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.314261574&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Forigin-of-symmetry%2Fid314261574%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(56, 47, 49);">Megalomania</a></li>
			</ol>
		</div>
	</div>
	<br class="clear">
</div>
<a href="#" class="close">×</a>
</div>










<div class="folderContent agaetisbyrjun" style="display: none; background-color: rgb(44, 52, 68);">
	<div class="jaf-container">
		<div>
			<div class="art-wrap" style="box-shadow: rgb(44, 52, 68) 12px 15px 20px inset, rgb(44, 52, 68) -1px -1px 150px inset;">
				<i class="fa fa-search"></i>
			</div>
			<h2><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Ágætis byrjun</a></h2>
			<h3 class="secondaryColor" style="color: rgb(255, 255, 255);">Sigur Rós (1999)</h3>
			<div class="multi">
				<ol class="secondaryColor" style="color: rgb(255, 255, 255);">
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Intro</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Svefn-g-englar</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Starálfur</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Flugufrelsarinn</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Ný batterí</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Hjartað hamast (bamm bamm bamm)</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Viðrar vel til loftárása</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Olsen Olsen</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Ágætis byrjun</a></li>
					<li><a href="http://click.linksynergy.com/link?id=wyucSOE7tvo&amp;offerid=146261.402946221&amp;type=2&amp;murl=https%3A%2F%2Fitunes.apple.com%2Falbum%2Fagaetis-byrjun%2Fid402946221%3Fuo%3D5" target="_blank" class="primaryColor" style="color: rgb(133, 137, 146);">Avalon</a></li>
				</ol>
			</div>
		</div>
		<br class="clear">
	</div>
	<a href="#" class="close">×</a>
</div>
</div>


</div>

</div>


@stop

@section('scripts')
<script src="http://app-folders.com/barebones/js/jquery.app-folders.js"></script>

<script type="text/javascript">

	$(function() {
		$('.app-folders-container').appFolders({
			opacity: .5, 								// Opacity of non-selected items
			marginTopAdjust: true, 						// Adjust the margin-top for the folder area based on row selected?
			marginTopBase: 0, 							// If margin-top-adjust is "true", the natural margin-top for the area
			marginTopIncrement: 30,						// If margin-top-adjust is "true", the absolute value of the increment of margin-top per row
			animationSpeed: 200,						// Time (in ms) for transitions
			URLrewrite: true, 							// Use URL rewriting?
			URLbase: "/barebones/",						// If URL rewrite is enabled, the URL base of the page where used. Example (include double-quotes): "/services/"
			internalLinkSelector: ".jaf-internal a",	// a jQuery selector containing links to content within a jQuery App Folder
			instaSwitch: true
		});
	});

	$(function(){
		$("#search_bar a").click(function (e) {
			console.log($("#srch-term"),e);
			$("#srch-term")[0].focus()
		})
	});

	$("#test1").click(function () {
		console.log('working');
		$("#collections .front").animate({left:"100%"}, 800)
	})
	$("#test2").click(function () {
		console.log('working');
		$("#collections .front").animate({left:"25%"}, 250)
	})
</script>

@stop

@section('style')
<link href="/assets/css/jquery.app-folder.css" rel="stylesheet" type="text/css"/>

<style>
/**/
	
</style>
@stop
