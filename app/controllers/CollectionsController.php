<?php

class CollectionsController extends PermissionsController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
	public function getIndex()
	{

// Grab all the collections

		$collections = Collection::all();

		// Show the page
		return View::make('backend/collections/index', compact('collections'));
	}

public function create()
{
 
 return View::make('backend/collections/create');
}

public function edit($id)
	{
		$collection = Collection::find($id);

		return View::make('backend/collections/edit', compact('collection'));
	}





}
