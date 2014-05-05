<?php

class PlayerController extends BaseController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
	public function single($id){
		$asset = Asset::find($id);
		return View::make('player.single')->with('asset', $asset);
	}

	public function playlist($id){
		$playlist = Playlist::find($id);
		$playlist->assets;
		// return $playlist;
		return View::make('player.playlist')->with('playlist', $playlist);
	}

	public function collection($id){
		$collection = Collection::find($id);
		return $collection;
		return View::make('player.collection')->with('collection', $collection);
	}




}
