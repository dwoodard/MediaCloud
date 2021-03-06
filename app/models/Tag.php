<?php

/**
 * Tag
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Asset[] $assets
 */
class Tag extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function assets()
	{
		return $this->belongsToMany('Asset');
	}
}
