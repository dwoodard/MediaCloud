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


	public function collection($id = null)
	{
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

	public function playlist($collection_id = null, $playlist_id = null)
	{
		$user =  User::find(Sentry::getUser()->id);

		$collection = Collection::find($user->collections->find($collection_id)->id);
		$playlists = $collection->playlists->find($playlist_id);
		$collection->assets;



		foreach ($collection->playlists as $key => $playlist) {
			$collection->playlists->merge($playlist->assets);
		}

		$playlists_group = array(array($collection->playlists->find($playlist_id)->toArray()));

		$data = array(
			'collection'=>$collection,
			'playlists_group'=> $playlists_group,
			'assets'=> $user->assets,
			);
		// return $data;
		return View::make('frontend.manage.playlist-item', $data);
	}

	public function browse($id = null)
	{
		$user = User::find($id);
		$assets = array();
		foreach ($user->assets as $key => $asset)
		{
			array_push($assets, $asset);
		}

		$data = array('assets' => $assets );

		return View::make('frontend.manage.browse-assets', $data);


	}

	public function context_menu($type=null)
	{
		return View::make('frontend.manage.context-menu');
	}


	public function store()
	{
		// return array(Input::get("userId"), Input::file('file'));
		// return Input::all();
		try{
			$this->uploadCreator->make(Input::get("userId"), Input::file('file'));
		}
		catch(\MC\Exceptions\ValidationException $e){
			return $e;
		}
	}

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

    //manage/cpa/add
    public function cpa_add($value='')
    {
    	throw new Exception("Error Processing Request", 1);

    }

    /**
    *todo: I don't think this should be here?
    */
	// public function newCollection()
	// {
	// 	$collection =  new Collection;

	// 	// Update the  collection data
	// 	$collection->name            = Input::get('name');
	// 	$collection->description        = Input::get('description');

	// 	// Was the  collection created?
	// 	if($collection->save())
	// 	{
	// 		// Redirect to the new  collection page
	// 		return Redirect::to("admin/collections")->with('success', Lang::get('admin/blogs/message.create.success'));
	// 	}

	// 	// Redirect to the  collection create page
	// 	return Redirect::to('admin/collections')->with('error', Lang::get('Error Adding Collection'));
	// }

}
