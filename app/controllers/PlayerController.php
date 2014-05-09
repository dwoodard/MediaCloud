<?php

class PlayerController extends BaseController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
	public function asset($id){
		$asset = Asset::find($id);
		return View::make('player.asset')->with('asset', $asset);
	}

	public function playlist($id){
		$playlist = Playlist::playlist_asset($id);
		return View::make('player.cpa')->with('playlist', $playlist)->with('type', Str::plural(Request::segment(2)));
	}

	public function collection($id){
		$collection = Collection::collection_playlist_asset($id);
		return View::make('player.cpa')->with('collection', $collection)->with('type', Str::plural(Request::segment(2)));
	}




}
