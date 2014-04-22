<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>



<div class="context-menu-one box menu-1">
    <strong>left click me</strong>
</div>



<div class="context-menu open">
	


	<header>{{Str::title($type)}} <i class="close fa fa-times-circle-o"></i></header>
	<div class="wrapper">
		@if($type == 'collection')
		<ul id="menu-collection">
			<li><a href="#" id="play">Play</a></li>
			<li class="dropdown-submenu"><a href="#" id="rename">Rename</a></li>
			<li><a href="#" id="collection"><span id="collection-label">Add to Collection</span><span id="collection-check"></span></a></li>
			<li class="dropdown-submenu"><a href="#" id="add-to">Add to...</a></li>
			<li><a href="#" id="publish">Make public</a></li>
			<li><a href="#" id="share">Share...</a></li>
			<li><a href="#" id="start-radio">Start Radio</a></li>
			<li><a href="#" id="copy-url">Copy URL<span></span></a></li>
			<li><a href="#" id="delete-collection">Delete<span class="delete-check"></span></a></li>
		</ul>

		<div class="collection">
			Collection stuff
		</div>
		@elseif($type == 'playlist')
		<ul id="menu-playlist">
			<li><a href="#" id="play">Play</a></li>
			<li><a href="#" id="collection"><span id="collection-label">Add to Collection</span><span id="collection-check"></span></a></li>
			<li><a href="#" id="starred"><span id="star-label">Star</span><span id="star-check"></span></a></li>
			<li class="dropdown-submenu"><a href="#" id="add-to">Add to...</a></li>
			<li><a href="#" id="publish">Make public</a></li>
			<li><a href="#" id="share">Share...</a></li>
			<li><a href="#" id="copy-url">Copy URL<span></span></a></li>
			<li><a href="#" id="delete-playlist">Delete<span class="delete-check"></span></a></li>
		</ul>

		<div class="playlist">Playlist stuff</div>

		@elseif($type == 'asset')
		<ul id="menu-asset">
			<li><a href="#" id="play">Play</a></li>
			<li><a href="#" id="collection"><span id="collection-label">Add to Collection</span><span id="collection-check"></span></a></li>
			<li><a href="#" id="starred"><span id="star-label">Star</span><span id="star-check"></span></a></li>
			<li class="dropdown-submenu"><a href="#" id="add-to">Add to...</a></li>
			<li><a href="#" id="publish">Make public</a></li>
			<li><a href="#" id="share">Share...</a></li>
			<li><a href="#" id="copy-url">Copy URL<span></span></a></li>
			<li><a href="#" id="delete-asset">Delete<span class="delete-check"></span></a></li>
		</ul>

		<div class="asset">Asset stuff</div>
		@endif




	</div>

</div>