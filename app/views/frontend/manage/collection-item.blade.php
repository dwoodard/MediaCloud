
<div id="current-collection"  data-current-collection-id="{{$collection->id}}">
	<header>
		<h2><a id="CollectionName" data-editable-data="collection-{{$collection->id}}" data-name="name" href="#" class="editable" data-editable-type="text" >{{$collection->name}}</a></h2>
		@if($collection->description)
		<h3><a href="#" class="editable" data-name="description" data-editable-data="collection-{{$collection->id}}" data-editable-type="text">{{$collection->description}}</a></h3>
		@else
		<h3><a href="#" class="editable" data-name="description" data-editable-data="collection-{{$collection->id}}" data-editable-type="text">Add Description</a></h3>
		@endif
		<td> <a href="#" class="context-menu" data-type="asset"><i class="fa fa-ellipsis-h fa-border pull-right"></i></a> </td>

		

		<div id="collection-toolbar" class="btn-group " role="toolbar">
			<button class="share btn btn-primary">Share ...</button>
			<button class="btn"> <i class="context-menu-btn fa fa-ellipsis-h " data-type="collection"></i> </button>
		</div>


	</header>




	<ul class="nav nav-tabs">
		<li class="active"><a href="#playlists-container" data-toggle="tab">Playlists</a></li>
		<li><a href="#assets-container" data-toggle="tab">Assets</a></li>
		<li><a href="#settings-container" data-toggle="tab">Settings</a></li>
		<li><a href="#deployments-container" data-toggle="tab">Deployments</a></li>
		<li class="pull-right">
			<a id="btn-new-playlist" href="#"><i class="fa fa-plus"></i> New Playlist</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="playlists-container">

			<div id="newPlaylist" style="display:none">
				<input id="input-new-playlist" type="text" value="Playlist Name" class="input-sm">
				<button id="btn-save-new-playlist"><i class="fa fa-check"></i> </button>
				<button id="btn-cancel-new-playlist"><i class="fa fa-times"></i> </button>
			</div>

			<!-- .app-folders-container -->
			<div class="app-folders-container" style="margin-top: 0px;">

				@include('frontend.manage.playlist-item')

			</div> <!-- .app-folders-container -->

		</div>

		<div class="tab-pane droppable clearfix" id="assets-container">

			@if(isset($collection->assets))
			<div class="col-md-9">
				<table id="cp-{{$collection->id}}-0" class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Title</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody class="sortable">
						@foreach ($collection->assets as $key => $asset)
						<tr id="cpa-{{$collection->id}}-0-{{$asset->id}}" data-asset-id="{{$asset->id}}">
							<td width="7px"><a class="asset-player-btn" href="#"><i class="fa fa-play-circle-o"></i></a></td>
							<td><a href="#" class="editable" data-name="title" data-editable-data="asset-{{$asset['id']}}" data-editable-type="text">{{$asset->title}}</a></td>
							@if(isset($asset->description))
							<td><a href="#" class="editable" data-name="description" data-editable-data="asset-{{$asset['id']}}" data-editable-type="text">{{$asset->description}}</a></td>
							@else
							<td><a href="#" class="editable" data-name="description" data-editable-data="asset-{{$asset['id']}}" data-editable-type="text">Add Description</a></td>
							@endif
							<td> 
								<button class="btn"> <i class="context-menu-btn fa fa-ellipsis-h " data-type="asset"></i> </button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			@else

			<div class="col-md-9">
				<table id="cp-{{$collection->id}}-0" class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Title</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody class="sortable">
					</tbody>
				</table>
			</div>

			@endif

		</div>

		<div class="tab-pane" id="settings-container">Settings</div>

		<div class="tab-pane" id="deployments-container">Deployments</div>

	</div>

</div>

