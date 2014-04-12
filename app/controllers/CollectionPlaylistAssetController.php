<?php

class CollectionPlaylistAssetController extends \BaseController {

	public function index()
	{
        return  CollectionPlaylistAsset::all();
	}

	public function test()
	{
        return  CollectionPlaylistAsset::all();
	}



	public function update_order_by_cpa(){

		
		$cpa =  CollectionPlaylistAsset::where('collection_id', '=', Input::get('collection_id'))
				->where('playlist_id', '=', Input::get('playlist_id'), 'AND')
				->where('asset_id', '=', Input::get('asset_id'), 'AND')
				->get()
				->first();
		//return $cpa;

			$cpa->asset_order = Input::get('asset_order');
			$cpa->save();

			return $cpa;
	}

	public function show($id)
	{
        return  CollectionPlaylistAsset::find($id);
	}


}

