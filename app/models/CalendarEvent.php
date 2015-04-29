<?php

/**
 * CalendarEvent
 *
 */
class CalendarEvent extends Eloquent {
	protected $table = 'events';

    // Add your validation rules here
    public static $rules = [
        'ca_id' => 'required|integer',
        'user_id' => 'required|integer',
        'title' => 'required',
        'start' => 'required',
        'end' => 'required',
    ];

	protected $fillable = [
		"ca_id",
		"user_id",
		"title",
		"location",
		"start",
		"end",
		"description",
	];

}
