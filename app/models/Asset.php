<?php

/**
 * An Eloquent Model: 'Asset'
 *
 * @property integer $id
 * @property string $alpha_id
 * @property string $title
 * @property string $description
 * @property string $filepath_original
 * @property string $filepath_transcoded
 * @property string $url_original
 * @property string $url_transcoded
 * @property string $type
 * @property string $status
 * @property string $permissions
 * @property string $tags
 * @property integer $views
 * @property integer $uploaded_by
 * @property \Carbon\Carbon $last_viewed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \User $user
 * @property-read \Playlist $playlists
 * @property-read \Collection $collections
 */
class Asset extends Eloquent implements AssetRepository {

	protected $table = 'assets';

	public function getLastAssets($amount)
	{
		// $assets = DB::select("SELECT * FROM assets ORDER BY  created_at DESC LIMIT 0 , $amount");
		$assets = Asset::paginate($amount);
		return $assets;
	}

	public function getAll($page_count = 15)
	{
		// $assets = DB::select("SELECT * FROM assets ORDER BY  created_at DESC LIMIT 0 , $amount");

		return Asset::orderBy('id', 'desc')->paginate($page_count);

	}



	public function ext()
	{
		switch ($this->type) {
			case 'video':
				return "mp4";
			break;
			case 'audio':
				return "mp3";
			break;
			default:
				return $this->original_ext;
			break;
		}
	}

	public function fileLocation($item_location)
	{
		switch ($item_location) {

			case 'original':
				return base_path(). "/" . Config::get('settings.media-path-original')  . "/" .  $this->alphaID . '.' . $this->original_ext;
			break;

			case 'transcoded':
				return base_path(). "/" . Config::get('settings.media-path'). "/". $this->alphaID . '.' . $this->ext();
			break;

			case 'transcoded-thumb':
				return base_path(). "/" . Config::get('settings.media-path'). "/". $this->alphaID."-thumb.jpg";
			break;
		}

		// $mediaPathOriginal = base_path(). "/" . Config::get('settings.media-path-original');
		// $mediaPathTranscoded = base_path(). "/" . Config::get('settings.media-path');
		// $filenameOriginal =  $this->alphaID . '.' . $this->original_ext;
		// $filenameTranscoded =  $this->alphaID . '.' . $ext;
		// $filenameTranscodedThumb =   $this->alphaID."-thumb.jpg";

		// $original = "$mediaPathOriginal/$filenameOriginal";

	}

	public function users()
	{
		return $this->belongsToMany('User');
	}

	public function playlists()
	{
		return $this->belongsToMany('Playlist');
	}

	public function collections()
	{
		return $this->belongsToMany('Collection');
	}

	public static function unassigned($user_id)
	{

		$cpa_assets = array();
		foreach (DB::select("SELECT asset_id FROM asset_collection UNION SELECT asset_id FROM  asset_playlist") as $key => $value) {
			array_push($cpa_assets, $value->asset_id);
		}
		if (empty($cpa_assets)) {
			$cpa_assets = array('0');
		}
		return DB::select("SELECT * FROM assets WHERE id IN ((SELECT asset_id FROM asset_user WHERE asset_id NOT IN ( ".implode(',', $cpa_assets)." ) AND user_id = ".$user_id. "))" );
		// return DB::select("SELECT * FROM assets WHERE id IN ((SELECT asset_id FROM asset_user WHERE asset_id NOT IN ( (SELECT asset_id FROM asset_playlist asset_collection) ) AND user_id = ".$user_id. "))" );
	}

}



