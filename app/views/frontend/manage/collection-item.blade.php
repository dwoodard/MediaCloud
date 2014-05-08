
<div id="current-collection"  data-current-collection-id="{{$collection->id}}">
	<header>
		<h2><a id="CollectionName" data-editable-data="collection-{{$collection->id}}" data-name="name" href="#" class="editable" data-editable-type="text" >{{$collection->name}}</a></h2>


		<h3><a href="#" class="editable" data-name="description" data-editable-data="collection-{{$collection->id}}" data-editable-type="text">
			@if($collection->description)
			{{$collection->description}}
			@else
			Add Description
			@endif
		</a></h3>

		<div id="collection-toolbar" class="btn-group " role="toolbar">
			<button class="share-select btn btn-primary" data-toggle="modal" data-target="#collectionShare">Share Collection ...</button>

<div class="modal fade"  id="collectionShare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Share This Collection</h4>
      </div>
      <div class="modal-body">
      <p>Hit <strong>(CTRL/CMD)+C</strong> to copy the link to your clipboard!</p>
      <br>
      <input id="current-collection-direct-link" class="form-control share-select " type="text" value="{{URL::to('/').'/player/collection/'.$collection->id }}">
      <br>
      <p>Embed This Collection on your webpage!</p>
      <br>
      <input id="current-collection-embed-link" class="form-control share-select" class="form-control " type="text" value="<iframe width='100%' height='100%' src='{{URL::to('/').'/player/collection/'.$collection->id }}' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>">
      <br>
      <i class="fa fa-external-link-square"></i><a href="{{URL::to('/').'/player/collection/'.$collection->id }}"> Preview Here</a> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>



			<!-- ContextMenu -->
			<div class="context-menu-container dropdown keep-open pull-right">

				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-ellipsis-h"></i>
				</button>
				<ul class="dropdown-menu">
					<li>
						@include('frontend.manage.context-menu')
					</li>
				</ul>

			</div>
			<!-- / ContextMenu -->
		</div>


	</header>




	<ul class="nav nav-tabs">
		<li class="active"><a href="#playlists-container" data-toggle="tab">Playlists (<span>{{count($collection->playlists)}}</span>)</a></li>
		<li><a href="#assets-container" data-toggle="tab">Assets (<span>{{count($collection->assets)}}</span>)</a></li>
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
							<td width="7px">
								@if($asset->status == "transcoded:complete")
								<a class="asset-player-btn" href="#"><i class="fa fa-play-circle-o"></i></a>
								@else
								<i class="fa fa-clock-o fa-spin"></i>
								@endif
							</td>
							<td><a href="#" class="editable" data-name="title" data-editable-data="asset-{{$asset['id']}}" data-editable-type="text">{{$asset->title}}</a></td>
							<td>
								<a href="#" class="editable" data-name="description" data-editable-data="asset-{{$asset['id']}}" data-editable-type="text">
									@if(isset($asset->description))
									{{$asset->description}}
									@else
									Add Description
									@endif
								</a>
							</td>

							<td>

								<!-- Collection Assets ContextMenu -->
								<div class="context-menu-container dropdown keep-open pull-right">

									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-ellipsis-h"></i>
									</button>
									<ul class="dropdown-menu">
										<li>
											@include('frontend.manage.context-menu')
										</li>
									</ul>

								</div>
								<!-- / ContextMenu -->


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

