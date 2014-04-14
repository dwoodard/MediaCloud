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

		$cpa = new CollectionPlaylistAsset;
		$cpa = $cpa->get_cpa_by_user_id(Sentry::getUser()->id);

		$unassignedAssets =  $this->asset->unassigned(Sentry::getUser()->id);
		$data = array('cpas' => $cpa, 'unassignedAssets' => $unassignedAssets);
		return View::make('frontend.manage.collection', $data);

	}


	public function collection($id = null)
	{
		$cpa = new CollectionPlaylistAsset;
		$cpa = $cpa->get_cpa_by_user_id(Sentry::getUser()->id);

		foreach ($cpa as $key => $item) {
			if ($id == $item->id) {
					// $data = array('item' => $item, 'cpas' => $cpa, 'cpa_rows'=> $cpa_rows, 'unassignedAssets' => $unassignedAssets);

				$playlists = array();
				$count = 0;
				for ($i=0; $i < count($cpa); $i+=2) {
					array_push($playlists,array_slice($item->playlists, $count+$i, 2));
				}
				$data = array('item' => $item, 'playlists_group' => $playlists);
					// return json_encode($data['item']);
					// return $data['playlists_group'];
					// return json_encode($data['playlists_group']);
					// return json_encode($data['playlists_group'][0][0]->assets['1']->name);
				return View::make('frontend.manage.collection-item', $data);
			}
		}

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
