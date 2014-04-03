<?php

class PlaylistsController extends PermissionsController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
	public function getIndex()
	{

// Grab all the playlists

		$playlists = Playlist::all();

		// Show the page
		return View::make('backend/playlists/index', compact('playlists'));
	}

	public function postIndex()
	{
	}


public function create()
{
 
 return View::make('backend/playlists/create');
}


public function edit($id)
	{
		$playlist = Playlist::find($id);

		return View::make('backend/playlists/edit', compact('playlist'));
	}


	public function destroy($id){


		// Check if the playlist exists
		if (is_null($playlist = playlist::find($id)))
		{
			// Redirect to the assets management page
			if (Request::ajax())
			{
				return json_encode(array('result' => 'failed', "description" => "File Not Found" ));
			}
			else{
				return Redirect::to('admin/assets')->with('error', Lang::get('admin/assets/message.not_found'));
			}
		}


		//Check CPA if playlist exsists

		//Remove pivot playlist
		foreach ($playlist->users as $user) {
			// $user->id;
			$playlist->users()->detach($user->id);
		}

		
		//remove the playlist in db
		$playlist->delete();

		if (Request::ajax())
		{
			return json_encode(array('result' => 'success' ));
		}
		else {
		// Redirect to the assets management page
			return Redirect::to('admin/playlists')->with('success', Lang::get('admin/assets/message.delete.success'));
		}
	}




}
