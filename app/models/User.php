<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

/**
 * An Eloquent Model: 'User'
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $permissions
 * @property boolean $activated
 * @property string $activation_code
 * @property \Carbon\Carbon $activated_at
 * @property \Carbon\Carbon $last_login
 * @property string $persist_code
 * @property string $reset_password_code
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $username
 * @property \Carbon\Carbon $deleted_at
 * @property string $website
 * @property string $country
 * @property string $gravatar
 * @property-read \Group $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\Asset[] $assets
 * @property-read \Illuminate\Database\Eloquent\Collection|\Collection[] $collections
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentry\Groups\Eloquent\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\Playlist[] $playlists
 * @property-read \Illuminate\Database\Eloquent\Collection|\CollectionPlaylistAsset[] $cpa
 */
class User extends SentryUserModel {
	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = true;

	/**
	 * Returns the user full name, it simply concatenates
	 * the user first and last name.
	 *
	 * @return string
	 */
	public function fullName()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	/**
	 * Returns the user Gravatar image url.
	 *
	 * @return string
	 */
	public function gravatar()
	{
		// Generate the Gravatar hash
		$gravatar = md5(strtolower(trim($this->gravatar)));

		// Return the Gravatar url
		return "//gravatar.org/avatar/{$gravatar}";
	}

	/**
	 * Returns the user Gravatar image url.
	 *
	 * @return string
	 */
	public function group()
	{
		return $this->hasMany('Group');
	}

	public function assets()
	{
		return $this->belongsToMany('Asset');
	}

	public function collections()
	{
		return $this->belongsToMany('Collection','collection_user');
	}

	public function playlists()
	{
		return $this->belongsToMany('Playlist', 'playlist_user');
	}

	public function cpa()
	{
		return $this->belongsToMany('CollectionPlaylistAsset');
	}


}
