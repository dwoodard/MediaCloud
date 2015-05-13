<?php

/**
 * CaptureAgent
 *
 */
class CaptureAgent extends Eloquent {
	protected $table = 'capture_agents';

	// Add your validation rules here
	public static $rules = [
		'ip' => 'required|ip',
		'location' => 'required|string'
	];

	// Don't forget to fill this array
	protected $fillable = [
        'ip',
        'location'
    ];

}