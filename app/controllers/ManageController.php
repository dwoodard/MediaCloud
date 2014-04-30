<?php

use MC\Exceptions\UploadException;
use MC\Services\UploadCreatorService;


class ManageController extends PermissionsController {

	protected $asset;
	protected $uploadCreator;

	public function __construct(AssetRepository $asset, UploadCreatorService $uploadCreator) {
		$this->asset = $asset;
		$this->uploadCreator = $uploadCreator;
	}

	public function index(){

		$user =  User::find(Sentry::getUser()->id);
		$collections = $user->collections->first();
		$collection = (Object) array();
		if ($collections) {
			$collection = Collection::find($collections->id);
		}else{

			$collection->id = null;
		}
		// return $user->collections;

		$unassignedAssets =  $this->asset->unassigned(Sentry::getUser()->id);
		$data = array('unassignedAssets' => $unassignedAssets, 'user_collections' => $user->collections, 'collection' => $collection  );
		// return $user->collections->toArray();
		return View::make('frontend.manage.collection', $data);
	}


	public function collection($id = null){
		if ($id == "null" || $id == null) {
			return array();
		}

		$user =  User::find(Sentry::getUser()->id);

		$collection = Collection::find($user->collections->find($id)->id);
		$collection->playlists;
		$collection->assets;
		// return $collection;
		foreach ($collection->playlists as $key => $playlist) {

			$collection->playlists->merge($playlist->assets);
		}

		$playlists_group = array();
		$count = 0;
		for ($i=0; $i < count($collection->playlists); $i+=4) {
			array_push($playlists_group,array_slice($collection->playlists->toArray(), $count+$i, 4));
		}

		$data = array(
			'collection'=>$collection,
			'playlists_group'=> $playlists_group,
			'assets'=> $user->assets,
			);

		// return $data['collection'];
		return View::make('frontend.manage.collection-item', $data);
	}

	public function playlist($collection_id = null, $playlist_id = null){
		$user =  User::find(Sentry::getUser()->id);

		$collection = Collection::find($user->collections->find($collection_id)->id);
		$playlists = $collection->playlists->find($playlist_id);
		$collection->assets;



		foreach ($collection->playlists as $key => $playlist) {
			$collection->playlists->merge($playlist->assets);
		}

		// return $collection->playlists->find($playlist_id)->toArray();

		$playlists_group = array(array($collection->playlists->find($playlist_id)->toArray()));
		//return $playlists_group;
		$data = array(
			'collection'=>$collection,
			'playlists_group'=> $playlists_group,
			'assets'=> $user->assets,
			);
		// return $data;
		return View::make('frontend.manage.playlist-item', $data);
	}

	public function browse($id = null){
		$user = User::find($id);
		$assets = array();
		foreach ($user->assets as $key => $asset)
		{
			array_push($assets, $asset);
		}

		$data = array('assets' => $assets );

		return View::make('frontend.manage.browse-assets', $data);
	}

	public function context_menu($type=null){
		$data = array('type' => $type);
		return View::make('frontend.manage.context-menu',$data);
	}

	public function store(){
		// return array(Input::get("userId"), Input::file('file'));
		// return Input::all();
		try{
			$this->uploadCreator->make(Input::get("userId"), Input::file('file'));
		}
		catch(\MC\Exceptions\ValidationException $e){
			return $e;
		}
	}

	/*
	*ADD
	*/

	//manage/collection/add
	public function collection_add(){

		$collection = new Collection;
		$collection->name = Input::get('name');
		$collection->save();

		$collection->users()->attach(Input::get('userId'));
		return $collection;
	}

	//manage/playlist/add
	public function playlist_add(){

		$playlist = new Playlist;
		$playlist->name = Input::get('name');
		$playlist->save();

		$playlist->collections()->attach(Input::get('collection'));
		return $playlist;
	}

	//manage/asset/add
	public function asset_add(){
		$asset = Asset::find(Input::get('asset_id'));

		//attach to playlist or collection?
		switch (Input::get('type')) {
			case 'collection':
			$asset->collections()->attach(Input::get('collection_id'));
			break;
			case 'playlist':
			$asset->playlists()->attach(Input::get('playlist_id'));
			break;

		}
		return $asset;
	}


	/*
	*UPDATE
	*/

	//manage/collection/update
	public function collection_update(){
		$inputs = Input::all();
		$collection = Collection::find($inputs['pk']);
		$collection->$inputs['name'] = $inputs['value'];
		$collection->save();
	}

	//manage/playlist/update
	public function playlist_update(){
		$inputs = Input::all();
		$playlist = Playlist::find($inputs['pk']);
		$playlist->$inputs['name'] = $inputs['value'];
		$playlist->save();
	}

	//manage/asset/update
	public function asset_update(){
		$inputs = Input::all();
		$asset = Asset::find($inputs['pk']);
		$asset->$inputs['name'] = $inputs['value'];
		$asset->save();
	}


	/*
	*DELETE
	*/

	//manage/collection/delete
	public function collection_delete($id){

		$collection = Collection::find($id);

		/*Detach  Playlist with Assets*/
		$playlists = $collection->playlists->lists('id');
		foreach ($playlists as $key => $id) {

			$playlist = Playlist::find($id);
			$assets = $playlist->assets->lists('id');
			foreach ($assets as $assetId) {
				$playlist->assets()->detach($assetId);
			}

			$collection->playlists()->detach($id);
		}

		/*Detach  Assets*/
		$assets = $collection->assets->lists('id');
		foreach ($assets as $key => $id) {
			$collection->assets()->detach($id);
		}

		/*Detach User*/
		$users = $collection->users->lists('id');
		foreach ($users as $key => $id) {
			$collection->users()->detach($id);
		}



		if ($collection->delete()) {
			return array('result' => 'deleted');
		}

		return $collection;
	}

	//manage/playlist/delete
	public function playlist_delete($id){
		$playlist = Playlist::find($id);
		$assets = $playlist->assets->lists('id');

		foreach ($assets as $assetId) {
			$playlist->assets()->detach($assetId);
		}

		if ($playlist->delete()) {
			return array('result' => 'deleted');
		}


		return $playlist;
	}

	//manage/asset/delete
	public function playlist_asset_delete($playlistId,$assetId){
		/*Detach  Playlist with Assets*/
		$asset = Asset::find($assetId);
		$playlists = $asset->playlists()->detach($playlistId);

		return $asset;
	}

	//manage/asset/delete
	public function asset_delete($id){
		$asset = Asset::find($id);

		/*Detach Collection with Assets*/
		$collection = $asset->collections->lists('id');
		foreach ($collection as $key => $id) {
			$asset->collections()->detach($id);
		}

		return $asset;
	}





	public function tag_add()
	{


		$tag = new Tag;
		$tag->name =Input::get('name');
		$tag->save();
		$tag->assets()->attach(1);

	}














	public function update_order_by_type()
	{

		switch (Input::get('type')) {
			case 'collection':
			$result = DB::table('asset_playlist')
			->where('playlist_id', Input::get('collection_id'))
			->where('asset_id', Input::get('asset_id'))
			->update(array('asset_order' => Input::get('asset_order')));
			break;
			case 'playlist':
			$result = DB::table('asset_playlist')
			->where('playlist_id', Input::get('playlist_id'))
			->where('asset_id', Input::get('asset_id'))
			->update(array('asset_order' => Input::get('asset_order')));
			break;

			default:
			break;
		}

		return  Input::get('asset_order');
	}

}
