<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>

<div class="context-menu open">


	@if($type == 'collection')
	<div id="menu-collection" class="collection-menu">
		<ul class="dropdown-interior-menu">
			<li><a href="#" id="play">Play</a></li>
			<li class="dropdown-submenu"><a href="#" id="rename">Rename</a></li>
			<li><a href="#" id="collection"><span id="collection-label">Add to Collection</span><span id="collection-check"></span></a></li>
			<li class="dropdown-submenu"><a href="#" id="add-to">Add to…</a></li>
			<li><a href="#" id="publish">Make public</a></li>
			<li><a href="#" id="share">Share…</a></li>
			<li><a href="#" id="start-radio">Start Radio</a></li>
			<li><a href="#" id="copy-url">Copy URL<span></span></a></li>
			<li><a href="#" id="delete-collection">Delete<span class="delete-check"></span></a></li>
		</ul>
	</div>
	@elseif($type == 'playlist')
	<div id="menu-playlist" class="playlist-menu">
		<ul class="dropdown-interior-menu">
			<li><a href="#" id="play">Play</a></li>
			<li><a href="#" id="remove-from-queue">Remove from Queue</a></li>
			<li><a href="#" id="play-next">Add to Queue</a></li>
			<li class="dropdown-submenu"><a href="#" id="rename">Rename</a></li>
			<li><a href="#" id="collection"><span id="collection-label">Add to Collection</span><span id="collection-check"></span></a></li>
			<li><a href="#" id="starred"><span id="star-label">Star</span><span id="star-check"></span></a></li>
			<li class="dropdown-submenu"><a href="#" id="add-to">Add to…</a></li>
			<li><a href="#" id="publish">Make public</a></li>
			<li><a href="#" id="share">Share…</a></li>
			<li><a href="#" id="start-radio">Start Radio</a></li>
			<li><a href="#" id="copy-url">Copy Spotify URL<span></span></a></li>
			<li><a href="#" id="follow">Follow</a></li>
			<li><a href="#" id="delete-playlist-asset">Delete<span class="delete-check"></span></a></li>
			<li><a href="#" id="delete-playlist">Delete<span class="delete-check"></span></a></li>
		</ul>
	</div>
	@endif

	

	<div class="playlist">Playlist stuff</div>
	<div class="collection">Collection stuff</div>

</div>