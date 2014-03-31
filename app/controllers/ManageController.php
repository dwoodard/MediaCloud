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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function test()
	{
		return View::make('frontend.manage.test');
	}

	public function collection()
	{
		$cpa = new CollectionPlaylistAsset;
        $cpa = $cpa->get_cpa_by_user_id(Sentry::getUser()->id);

        $cpa_rows = array();
		$count = 0;
		for ($i=0; $i < count($cpa); $i+=4) {
			array_push($cpa_rows,array_slice($cpa, $count+$i, 4));
		}

		$unassignedAssets =  $this->asset->unassigned(Sentry::getUser()->id);
		$data = array('cpas' => $cpa, 'cpa_rows'=> $cpa_rows, 'unassignedAssets' => $unassignedAssets);

		return View::make('frontend.manage.collection', $data);
	}


	public function browse()
	{
		return View::make('frontend.manage.browse');
	}

	public function upload()
	{
		$cpa = new CollectionPlaylistAsset;
        $cpa = $cpa->get_cpa_by_user_id(Sentry::getUser()->id);

        $cpa_rows = array();
		$count = 0;
		for ($i=0; $i < count($cpa); $i+=4) {
			array_push($cpa_rows,array_slice($cpa, $count+$i, 4));
		}

		$unassignedAssets =  $this->asset->unassigned(Sentry::getUser()->id);
		$data = array('cpas' => $cpa, 'cpa_rows'=> $cpa_rows, 'unassignedAssets' => $unassignedAssets);

		return View::make('frontend.manage.upload', $data);
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



}
