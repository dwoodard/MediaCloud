<?php

// Use Sentry;

class CollectionsController extends PermissionsController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
	public function index($id = null)
	{
		// Sentry::getUser()->id;
		$user = User::find(Sentry::getUser()->id);
		return $user->collections()->get();
		// return json_encode($user->collections());

		// return Collection::all();
		// Grab all the collections
		if (Request::ajax()) {
			if (is_numeric($id)) {
				return Collection::find($id);
			}else{
				return Collection::all();
			}
		}

		// Show the page
		// return View::make('backend/collections/index', compact('collections'));
	}

	public function create()
	{


	}


	public function store()
	{

		$collection = new Collection;
		$collection->name = Input::get('name');
		$collection->save();

		$user = User::find(Input::get('userId'));
		$user->collections()->attach($collection->id);

		return 'hey';
	}


	public function edit($id)
	{
		$collection = Collection::find($id);

		return View::make('backend/collections/edit', compact('collection'));
	}





}
