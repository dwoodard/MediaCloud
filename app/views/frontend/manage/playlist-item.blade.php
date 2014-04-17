@foreach($playlists_group as $key => $playlists)
<div class="jaf-row jaf-container">
	@foreach ($playlists as $key => $playlist)
	<div class="folder" id="{{camel_case($playlist['name'])}}" style="opacity: 1;">
		<a href="">
			<img src="/assets/img/collection-icon-close.png" alt="">
			<p class="album-name">{{$playlist['name']}} </p>
		</a>
	</div>
	@endforeach
	<br class="clear">
</div>
@foreach ($playlists as $key => $playlist)
<div class="folderContent {{camel_case($playlist['name'])}}" style="display: none; background-color: rgb(224, 232, 233);">
	<div class="jaf-container">
		<div class="row">
			<div class="col-sm-12">
				<div class="assets row">
					<div class="col-sm-9">
						<h2> {{$playlist['name']}} </h2>

						<div class="col-sm-9 ">
							<table id="cp-{{$collection['id']}}-{{$playlist['id']}}" class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Title</th>
										<th>Description</th>
										<th></th>
									</tr>
								</thead>
								<tbody class="sortable">
									@foreach ($playlist['assets'] as $key => $asset)
									<tr id="cpa-{{$collection['id']}}-{{$playlist['id']}}-{{$asset['id']}}" class="" data-asset-id="{{$asset['id']}}">
										<td width="7px"><a class="asset-player-btn" href="#"><i class="fa fa-play-circle-o"></i></a></td>
										<td>{{$asset['title']}}</td>
										<td>{{$asset['description']}}</td>
										<td> <a href="#" class="context-menu" data-type="asset"><i class="fa fa-ellipsis-h fa-border pull-right"></i></a> </td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
		<br class="clear">
	</div>

</div> <!-- /.folderContent -->
@endforeach
@endforeach