<?php

class CollectionsController extends PermissionsController {

	public function index($id = null, $cpa = null)
	{
        $collections = Collection::all();


        return View::make('backend/collections/index', compact('collections'));

	}




	public function create()
	{


		return View::make('backend/collections/create');
	}

	public function store()
	{

		$collection =  new Collection;

		$collection->name            = e(Input::get('name'));
		$collection->description        = e(Input::get('description'));


		// Was the blog collection created?
		if($collection->save())
		{
			// Redirect to the new blog collection page
			return Redirect::to("admin/collections")->with('success', Lang::get('admin/blogs/message.create.success'));
		}

		// Redirect to the blog collection create page
		return Redirect::to('admin/collections')->with('error', Lang::get('Error Adding Collection'));




	}


	public function edit($id)
	{
		$collection = Collection::find($id);

		return View::make('backend/collections/edit', compact('collection'));
	}



	public function update($id)
	{


	// Check if the assets exists
		if (is_null($collection = Collection::find($id)))
		{
			// Redirect to the collections management page
			return Redirect::to('admin/collections')->with('error', Lang::get('Collection does not exist'));
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

		// Update the collection data
		$collection->name				= e(Input::get('name'));
		$collection->description			= e(Input::get('description'));




		// Was the collection updated?
		if($collection->save())
		{
			// Redirect to the new collection page
			return Redirect::to("admin/collections")->with('success', Lang::get('admin/collections/message.update.success'));
		}

		// Redirect to the collections post management page
		return Redirect::to("admin/collections/$collection->id/edit")->with('error', Lang::get('admin/collections/message.update.error'));
	}



	public function destroy($id)
	{

		// Check if the collection exists
		if (is_null($collection = collection::find($id)))
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


		//Check CPA if collection exsists

		//Remove pivot collection
		foreach ($collection->users as $user) {
			// $user->id;
			$collection->users()->detach($user->id);
		}


		//remove the collection in db
		$collection->delete();

		if (Request::ajax())
		{
			return json_encode(array('result' => 'success' ));
		}
		else {
		// Redirect to the assets management page
			return Redirect::to('admin/collections')->with('success', Lang::get('admin/assets/message.delete.success'));
		}
	}






}
