<?php

use MC\Exceptions\UploadException;
use MC\Services\UploadCreatorService;


class ManageController extends BaseController {

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
		// $cpa = new CollectionPlaylistAsset;
		// $cpa = $cpa->get_cpa_by_user_id(Sentry::getUser()->id);
		// return json_encode($cpa);


		$user =  User::find(Sentry::getUser()->id);

		$collection = Collection::find($user->collections->find($id)->id);
		$collection->playlists;
		$collection->assets;

		foreach ($collection->playlists as $key => $playlist) {

			$collection->playlists->merge($playlist->assets);
		}
		// return $collection;
		$playlists_group = array();
		$count = 0;
		for ($i=0; $i < count($collection->playlists); $i+=2) {
			array_push($playlists_group,array_slice($collection->playlists->toArray(), $count+$i, 2));
		}
		// return $playlists;

		// foreach ($playlists_group as $key => $playlists) {
		// 	foreach ($playlists as $key => $playlist) {
		// 			// var_dump($playlist);
		// 		foreach ($playlist['assets'] as $key => $asset) {
		// 			var_dump($asset);
		// 		}
		// 	}
		// }
		// die();

		$data = array(
			'collection'=>$collection,
			'playlists_group'=> $playlists_group,
			'assets'=> $user->assets,
			);
		// return $data;
		return View::make('frontend.manage.collection-item', $data);
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




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
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

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('frontend.manage.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('frontend.manage.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function newCollection()
	{
		$collection =  new Collection;

		// Update the  collection data
		$collection->name            = e(Input::get('name'));
		$collection->description        = e(Input::get('description'));

		// Was the  collection created?
		if($collection->save())
		{
			// Redirect to the new  collection page
			return Redirect::to("admin/collections")->with('success', Lang::get('admin/blogs/message.create.success'));
		}

		// Redirect to the  collection create page
		return Redirect::to('admin/collections')->with('error', Lang::get('Error Adding Collection'));
	}

}
