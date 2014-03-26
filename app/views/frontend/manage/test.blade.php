@extends('frontend/layouts/manage')


@section('content')
@include('_partials.subnav-manage')
<div ng-app="mcApp">



	<div id="main" class="">
		<div class="app-folders-container" style="margin-top: 0px;">
			<div class="jaf-row jaf-container">
				<div class="folder" id="okcomputer" style="opacity: 1;">
					<a href="#">
						<img src="/assets/img/collection-icon-close.png" alt="">
						<p class="album-name">OK Computer</p>
						<p class="artist-name">Radiohead</p>
					</a>
				</div>
				<div class="folder" id="intheaeroplane" style="opacity: 1;">
					<a href="#">
						<img src="/assets/img/collection-icon-close.png" alt="">
						<p class="album-name">In the Aeroplane Over the Sea</p>
						<p class="artist-name">Neutral Milk Hotel</p>
					</a>
				</div>
				<div class="folder" id="yankeehotelfoxtrot" style="opacity: 1;">
					<a href="#">
						<img src="/assets/img/collection-icon-close.png" alt="">
						<p class="album-name">Yankee Hotel Foxtrot</p>
						<p class="artist-name">Wilco</p>
					</a>
				</div>
				<div class="folder" id="sophtwareslump" style="opacity: 1;">
					<a href="#">
						<img src="/assets/img/collection-icon-close.png" alt="">
						<p class="album-name">The Sophtware Slump</p>
						<p class="artist-name">Grandaddy</p>
					</a>
				</div>
				<br class="clear">
			</div>

			<div class="folderContent sophtwareslump" style="display: none; background-color: rgb(146, 163, 177);">
				<div class="jaf-container">
					<div>
						<div class="art-wrap" style="box-shadow: rgb(146, 163, 177) 12px 15px 20px inset, rgb(146, 163, 177) -1px -1px 150px inset;">
							<img src="/assets/img/collection-icon-open.png" alt="">
						</div>
						<h2><a href="#%3D5" target="_blank" class="primaryColor">The Sophtware Slump</a></h2>
						<h3 class="secondaryColor">Grandaddy (2000)</h3>
						<div class="multi">
							<ol class="secondaryColor">
								<li><a href="#" target="_blank" class="primaryColor">He's Simple, He's Dumb, He's the Pilot</a></li>
								<li><a href="#" target="_blank" class="primaryColor">Hewlett's Daughter</a></li>
								<li><a href="#" target="_blank" class="primaryColor">Jed the Humanoid</a></li>
								<li><a href="#" target="_blank" class="primaryColor">The Crystal Lake</a></li>
								<li><a href="#" target="_blank" class="primaryColor">Chartsengrafs</a></li>
								<li><a href="#" target="_blank" class="primaryColor">Underneath the Weeping Willow</a></li>
								<li><a href="#" target="_blank" class="primaryColor">Broken Household Appliance National Forest</a></li>
								<li><a href="#" target="_blank" class="primaryColor">Jed's Other Poem (Beautiful Ground)</a></li>
								<li><a href="#" target="_blank" class="primaryColor">E. Knievel Interlude (The Perils of Keeping It Real)</a></li>
								<li><a href="#" target="_blank" class="primaryColor">Miner at the Dial-A-View</a></li>
								<li><a href="#" target="_blank" class="primaryColor">So You'll Aim Toward the Sky</a></li>
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
						<img src="/assets/img/collection-icon-open.png" alt="">
					</div>
					<h2><a href="#%3D5" target="_blank" class="primaryColor">Yankee Hotel Foxtrot</a></h2>
					<h3 class="secondaryColor">Wilco (2002)</h3>
					<div class="multi">
						<ol class="secondaryColor">
							<li><a href="#" target="_blank" class="primaryColor">I Am Trying to Break Your Heart</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Kamera</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Radio Cure</a></li>
							<li><a href="#" target="_blank" class="primaryColor">War on War</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Jesus, Etc.</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Ashes of American Flags</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Heavy Metal Drummer</a></li>
							<li><a href="#" target="_blank" class="primaryColor">I'm the Man Who Loves You</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Pot Kettle Black</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Poor Places</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Reservations</a></li>
						</ol>
					</div>
				</div>
				<br class="clear">
			</div>
			<a href="#" class="close">×</a>
		</div>
















		<div class="folderContent intheaeroplane" style="display: none; background-color: rgb(179, 185, 146);">
			<div class="jaf-container">
				<div>
					<div class="art-wrap" style="box-shadow: rgb(179, 185, 146) 12px 15px 20px inset, rgb(179, 185, 146) -1px -1px 150px inset;">
						<img src="/assets/img/collection-icon-open.png" alt="">
					</div>
					<h2><a href="#" target="_blank" class="primaryColor">In the Aeroplane Over the Sea</a></h2>
					<h3 class="secondaryColor">Neutral Milk Hotel (1998)</h3>
					<div class="multi">
						<ol class="secondaryColor">
							<li><a href="#" target="_blank" class="primaryColor">The King of Carrot Flowers Pt. One</a></li>
							<li><a href="#" target="_blank" class="primaryColor">The King of Carrot Flowers Pts. Two &amp; Three</a></li>
							<li><a href="#" target="_blank" class="primaryColor">In the Aeroplane Over the Sea</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Two-Headed Boy</a></li>
							<li><a href="#" target="_blank" class="primaryColor">The Fool</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Holland, 1945</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Communist Daughter</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Oh Comely</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Ghost</a></li>
							<li><a href="#" target="_blank" class="primaryColor">*</a></li>
							<li><a href="#" target="_blank" class="primaryColor">Two-Headed Boy Pt. Two</a></li>
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
					<img src="/assets/img/collection-icon-open.png" alt="">
				</div>
				<h2><a href="#" target="_blank" class="primaryColor">OK Computer</a></h2>
				<h3 class="secondaryColor">Radiohead (1997)</h3>
				<div class="multi">
					<ol class="secondaryColor">
						<li><a href="#" target="_blank" class="primaryColor">Airbag</a></li>
						<li><a href="#" target="_blank" class="primaryColor">Paranoid Android</a></li>
						<li><a href="#" target="_blank" class="primaryColor">Subterranean Homesick Alien</a></li>
						<li><a href="#" target="_blank" class="primaryColor">Exit Music (For a Film)</a></li>
						<li><a href="#" target="_blank" class="primaryColor">Let Down</a></li>
						<li><a href="#" target="_blank" class="primaryColor">Karma Police</a></li>
						<li><a href="#" target="_blank" class="primaryColor">Fitter Happier</a></li>
						<li><a href="#" target="_blank" class="primaryColor">Electioneering</a></li>
						<li><a href="#" target="_blank" class="primaryColor">Climbing Up the Walls</a></li>
						<li><a href="#" target="_blank" class="primaryColor">No Surprises</a></li>
						<li><a href="#" target="_blank" class="primaryColor">Lucky</a></li>
						<li><a href="#" target="_blank" class="primaryColor">The Tourist</a></li>
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
				<img src="/assets/img/collection-icon-close.png" alt="">
				<p class="album-name">Origin of Symmetry</p>
				<p class="artist-name">Muse</p>
			</a>
		</div>
		<div class="folder" id="yoshimibattlesthepinkrobots" style="opacity: 1;">
			<a href="#">
				<img src="/assets/img/collection-icon-close.png" alt="">
				<p class="album-name">Yoshimi Battles the Pink Robots</p>
				<p class="artist-name">The Flaming Lips</p>
			</a>
		</div>
		<div class="folder" id="kida" style="opacity: 1;">
			<a href="#">
				<img src="/assets/img/collection-icon-close.png" alt="">
				<p class="album-name">Kid A</p>
				<p class="artist-name">Radiohead</p>
			</a>
		</div>
		<div class="folder" id="agaetisbyrjun" style="opacity: 1;">
			<a href="#">
				<img src="/assets/img/collection-icon-close.png" alt="">
				<p class="album-name">Ágætis byrjun</p>
				<p class="artist-name">Sigur Rós</p>
			</a>
		</div>
		<br class="clear">
	</div>

	<div class="folderContent kida" style="display: none; background-color: rgb(9, 8, 9);">

	<div class="jaf-container">
		<div>
			<div class="art-wrap" style="box-shadow: rgb(9, 8, 9) 12px 15px 20px inset, rgb(9, 8, 9) -1px -1px 150px inset;">
				<img src="/assets/img/collection-icon-open.png" alt="">
			</div>
			<h2><a href="#" target="_blank" class="primaryColor">Kid A</a></h2>
			<h3 class="secondaryColor">Radiohead (2000)</h3>
			<div class="multi">
				<ol class="secondaryColor">
					<li><a href="#" target="_blank" class="primaryColor">Everything in its Right Place</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Kid A</a></li>
					<li><a href="#" target="_blank" class="primaryColor">The National Anthem</a></li>
					<li><a href="#" target="_blank" class="primaryColor">How to Disappear Completely</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Treefingers</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Optimistic</a></li>
					<li><a href="#" target="_blank" class="primaryColor">In Limbo</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Idioteque</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Morning Bell</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Motion Picture Soundtrack</a></li>
				</ol>
			</div>
		</div>
		<br class="clear">
	</div>
	<a href="#" class="close">×</a>
	</div>
	<div class="folderContent yoshimibattlesthepinkrobots" style="display: none; background-color: rgb(235, 212, 139);">
	<div class="jaf-container">
		<div>
			<div class="art-wrap" style="box-shadow: rgb(235, 212, 139) 12px 15px 20px inset, rgb(235, 212, 139) -1px -1px 150px inset;">
				<img src="/assets/img/collection-icon-open.png" alt="">
			</div>
			<h2><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">Yoshimi Battles the Pink Robots</a></h2>
			<h3 class="secondaryColor">The Flaming Lips (2002)</h3>
			<div class="multi">
				<ol class="secondaryColor">
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">Fight Test</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">One More Robot/Sympathy 3000-21</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">Yoshimi Battles the Pink Robots Part 1</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">Yoshimi Battles the Pink Robots Part 2</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">In the Morning of the Magicians</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">Ego Tripping at the Gates of Hell</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">Are You a Hypnotist??</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">It's Summertime</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">Do You Realize??</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">All We Have is Now</a></li>
					<li><a href="#%3Fuo%3D5" target="_blank" class="primaryColor">Approaching Pavonis Mons by Balloon (Utopia Planitia)</a></li>
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
				<img src="/assets/img/collection-icon-open.png" alt="">
			</div>
			<h2><a href="#%3D5" target="_blank" class="primaryColor">Origin of Symmetry</a></h2>
			<h3 class="secondaryColor">Muse (2005)</h3>
			<div class="multi">
				<ol class="secondaryColor">
					<li><a href="#%3D5" target="_blank" class="primaryColor">New Born</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Bliss</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Space Dementia</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Hyper Music</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Plug In Baby</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Citizen Erased</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Micro Cuts</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Screenager</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Dark Shines</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Feeling Good</a></li>
					<li><a href="#%3D5" target="_blank" class="primaryColor">Megalomania</a></li>
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
				<img src="/assets/img/collection-icon-open.png" alt="">
			</div>
			<h2><a href="#" target="_blank" class="primaryColor">Ágætis byrjun</a></h2>
			<h3 class="secondaryColor">Sigur Rós (1999)</h3>
			<div class="multi">
				<ol class="secondaryColor">
					<li><a href="#" target="_blank" class="primaryColor">Intro</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Svefn-g-englar</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Starálfur</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Flugufrelsarinn</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Ný batterí</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Hjartað hamast (bamm bamm bamm)</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Viðrar vel til loftárása</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Olsen Olsen</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Ágætis byrjun</a></li>
					<li><a href="#" target="_blank" class="primaryColor">Avalon</a></li>
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
	$(document).ready(function () {

		$('.app-folders-container').appFolders({
			opacity: .5, 								// Opacity of non-selected items
			marginTopAdjust: true, 						// Adjust the margin-top for the folder area based on row selected?
			marginTopBase: 0, 							// If margin-top-adjust is "true", the natural margin-top for the area
			marginTopIncrement: 0,						// If margin-top-adjust is "true", the absolute value of the increment of margin-top per row
			animationSpeed: 200,						// Time (in ms) for transitions
			// URLrewrite: true, 							// Use URL rewriting?
			// URLbase: "/barebones/",						// If URL rewrite is enabled, the URL base of the page where used. Example (include double-quotes): "/services/"
			internalLinkSelector: ".jaf-internal a",	// a jQuery selector containing links to content within a jQuery App Folder
			instaSwitch: true
		});

		$("#search_bar a").on( "click", function(e) {
			setTimeout(function(){
				$("#srch-term")[0].focus();
			}, 0);
		});
	});
</script>

@stop

@section('style')
<link href="/assets/css/jquery.app-folder.css" rel="stylesheet" type="text/css"/>

<style>

</style>
@stop
