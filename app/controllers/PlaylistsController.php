<?php

class PlaylistsController extends PermissionsController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
	public function index($id = null, $cpa = null)
	{
		$user = User::find(Sentry::getUser()->id);

		// /collections/null/null
		if (Request::segment(1) == 'playlists' && Request::segment(2) == null && Request::segment(3) == null) {
			return $user->collections()->get();
		}


		// /collections/$id/null
		if (Request::segment(2) == $id && Request::segment(3) == null) {
			return Collection::find($id);
		}


		// /collections/1/cpa
		if (Request::segment(3) == 'cpa') {

			return Playlist::playlist_asset($id);
		}
	}

	public function create()
	{

		return View::make('backend/playlists/create');
	}


	public function store()
	{
// Create a new Playlist
		$playlist =  new Playlist;

		// Update the blog playlist data
		$playlist->name            = e(Input::get('name'));
		$playlist->description        = e(Input::get('description'));


		// Was the blog playlist created?
		if($playlist->save())
		{
			// Redirect to the new blog playlist page
			return Redirect::to("admin/playlists")->with('success', Lang::get('admin/blogs/message.create.success'));
		}

		// Redirect to the blog playlist create page
		return Redirect::to('admin/playlists')->with('error', Lang::get('Error Adding playlist'));


	}









	public function edit($id)

	{
		$playlist = Playlist::find($id);

		return View::make('backend/playlists/edit', compact('playlist'));
	}



	public function update($id)
	{



	// Check if the assets exists
		if (is_null($playlist = Playlist::find($id)))
		{
			// Redirect to the playlists management page
			return Redirect::to('admin/playlists')->with('error', Lang::get('playlist does not exist'));
		}


		// Declare the rules for the form validation
		$rules = array(
			// 'name' => 'required',
			// 'description' => 'required',
			// 'filepath' => 'required',
			// 'filename' => 'required',
			// 'thumbnail_url' => 'required',
			// 'url' => 'required',
			// 'type' => 'required',
			// 'status' => 'required',
			// 'tags' => 'required',
			// 'views' => 'required',
			// 'last_viewed' => 'required',
			// 'created_at' => 'required',
			// 'updated_at' => 'required'
			);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Update the playlist data
		$playlist->name				= e(Input::get('name'));
		$playlist->description			= e(Input::get('description'));




		// Was the playlist updated?
		if($playlist->save())
		{
			// Redirect to the new playlist page
			return Redirect::to("admin/playlists")->with('success', Lang::get('admin/playlists/message.update.success'));
		}

		// Redirect to the playlists post management page
		return Redirect::to("admin/playlists/$playlist->id/edit")->with('error', Lang::get('admin/playlists/message.update.error'));
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
