<?php

class PlayerController extends BaseController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
		public function single($alphaID)
		{
			// echo "hey";
			// Show the page
			 //    return Asset::find($id);
	return View::make('player.single')->with('asset', Asset::where('alphaID', '=', $alphaID));
    


			return View::make('frontend/player/single');
		}

		public function playlist($id)
		{
			return View::make('frontend/player/playlist');
		}

	public function collection($id)
		{
			return View::make('frontend/player/collection');
		}




}
