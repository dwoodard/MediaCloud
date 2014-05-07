<?php

/**
 * An Eloquent Model: 'Playlist'
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Asset[] $assets
 * @property-read \Illuminate\Database\Eloquent\Collection|\Collections[] $collections
 */
class Playlist extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function assets()
	{
		return $this
		->belongsToMany('Asset')
		->withPivot('asset_order')
		->orderBy('pivot_asset_order', 'asc');
	}
	public function collections()
	{
		return $this->belongsToMany('Collection');
	}
	public static function playlist_asset($id)
	{

		$playlist = Playlist::find($id);
		$playlist->assets;
		return $playlist;
	}

}
