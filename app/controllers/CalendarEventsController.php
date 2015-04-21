<?php

class CalendarEventsController extends \BaseController {

	/**
	 * Display a listing of calendarevents
	 *
	 * @return Response
	 */
	public function index()
	{
		$calendarevents = Calendarevent::all();

		return View::make('calendarevents.index', compact('calendarevents'));
	}

	/**
	 * Show the form for creating a new calendarevent
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('calendarevents.create');
	}

	/**
	 * Store a newly created calendarevent in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Calendarevent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Calendarevent::create($data);

		return Redirect::route('calendarevents.index');
	}

	/**
	 * Display the specified calendarevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$calendarevent = Calendarevent::findOrFail($id);

		return View::make('calendarevents.show', compact('calendarevent'));
	}

	/**
	 * Show the form for editing the specified calendarevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$calendarevent = Calendarevent::find($id);

		return View::make('calendarevents.edit', compact('calendarevent'));
	}

	/**
	 * Update the specified calendarevent in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$calendarevent = Calendarevent::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Calendarevent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$calendarevent->update($data);

		return Redirect::route('calendarevents.index');
	}

	/**
	 * Remove the specified calendarevent from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Calendarevent::destroy($id);

		return Redirect::route('calendarevents.index');
	}

}
