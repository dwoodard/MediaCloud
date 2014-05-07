<?php

/**
 * An Eloquent Model: 'Collection'
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Asset[] $assets
 * @property-read \Illuminate\Database\Eloquent\Collection|\Playlist[] $playlists
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 */
class Collection extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function assets()
	{
		return $this
		->belongsToMany('Asset')
		->withPivot('asset_order')
		->orderBy('pivot_asset_order', 'asc');
	}

	public function playlists()
	{
		return $this->belongsToMany('Playlist');
	}

	public function users()
	{
		return $this->belongsToMany('User');
	}
	public function cpa($collection_id)
	{
		return $collection_id;
	}
	public static function collection_playlist_asset($id)
	{

		$collection = Collection::find($id);
		$collection->playlists;
		$collection->assets;
		foreach ($collection->playlists as $key => $playlist) {

			$collection->playlists->merge($playlist->assets);
		}
		return $collection;
	}

}
