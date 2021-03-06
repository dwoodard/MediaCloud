<?php

use MC\Exceptions\UploadException;
use MC\Services\UploadCreatorService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\StreamedResponse;


class AssetsController extends PermissionsController{

	protected $asset;
	protected $uploadCreator;

	public function __construct(AssetRepository $asset, UploadCreatorService $uploadCreator) {
		$this->asset = $asset;
		$this->uploadCreator = $uploadCreator;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected function index()
	{
		// Grab all the assets
		$assets = $this->asset->getAll();

		foreach ($assets as $asset) {

			$asset->users->each(function($user)
			{
				$asset->users[] = $user;
			});
		}

		// Show the page
		return View::make('backend/assets/index', compact('assets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		// Show the page
		return View::make('backend/assets/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
                $this->uploadCreator->make(Input::get("userId"), Input::file('file'));
            }
            catch(\MC\Exceptions\ValidationException $e){
                return $e;
//      return Redirect::back()->withInput()->withErrors($e->getErrors());

		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($assetId)
	{
//    return View::make('blahcs.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($assetId)
	{


		// Check if the asset exists
		if (is_null($asset = Asset::find($assetId)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/assets')->with('error', Lang::get('admin/assets/message.does_not_exist'));
		}

		// // Get the user information
		// $asset = Asset::find($assetId);

		// // Get this user groups
		// $userGroups = $user->groups()->lists('name', 'group_id');


		// // Get this user permissions
		// $userPermissions = array_merge(Input::old('permissions', array('superuser' => -1)), $user->getPermissions());
		// $this->encodePermissions($userPermissions);


		// // Get a list of all the available groups
		// $groups = Sentry::getGroupProvider()->findAll();

		// // Get all the available permissions
		// $permissions = Config::get('permissions');
		// $this->encodeAllPermissions($permissions);


		// Show the page
		// return View::make('backend/assets/edit', compact('user', 'asset','groups', 'userGroups', 'permissions', 'userPermissions'));
		return View::make('backend/assets/edit', compact('asset'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function update($assetId)
	{
		// Check if the assets exists
		if (is_null($asset = Asset::find($assetId)))
		{
			// Redirect to the assets management page
			return Redirect::to('admin/assets')->with('error', Lang::get('admin/assets/message.does_not_exist'));
		}


		// Declare the rules for the form validation
		$rules = array(
			'title' => 'required',
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

		// Update the asset data
		$asset->title				= e(Input::get('title'));
		$asset->description			= e(Input::get('description'));
		$asset->filepath			= e(Input::get('filepath'));
		// $asset->filename			= e(Input::get('filename'));
		// $asset->transcoded_url	= e(Input::get('transcoded_url'));
		// $asset->thumbnail_url	= e(Input::get('thumbnail_url'));
		// $asset->url				= e(Input::get('url'));
		$asset->type				= e(Input::get('type'));
		$asset->status				= e(Input::get('status'));
		// $asset->tags				= e(Input::get('tags'));
		// $asset->views			= e(Input::get('views'));
		// $asset->last_viewed		= e(Input::get('last_viewed'));
		// $asset->created_at		= e(Input::get('created_at'));
		// $asset->updated_at		= e(Input::get('updated_at'));



		// Was the asset updated?
		if($asset->save())
		{
			// Redirect to the new asset page
			return Redirect::to("admin/assets")->with('success', Lang::get('admin/assets/message.update.success'));
		}

		// Redirect to the assets post management page
		return Redirect::to("admin/assets/$assetId/edit")->with('error', Lang::get('admin/assets/message.update.error'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy($assetId){


		// Check if the asset exists
		if (is_null($asset = Asset::find($assetId)))
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


		//Check CPA if asset exsists

		//Remove pivot asset
		foreach ($asset->users as $user) {
			// $user->id;
			$asset->users()->detach($user->id);
		}

		// Delete the asset
		if ($asset->type == "video" || $asset->type == "audio") {
			file_exists($asset->fileLocation('transcoded')) 		? File::delete($asset->fileLocation('transcoded')):'';
			file_exists($asset->fileLocation('transcoded-thumb')) 	? File::delete($asset->fileLocation('transcoded-thumb')):'';
			file_exists($asset->fileLocation('original'))			? File::delete($asset->fileLocation('original')):'';
		}else{
			file_exists($asset->fileLocation('transcoded')) 		? File::delete($asset->fileLocation('transcoded')):'';
		}

		//remove the asset in db
		$asset->delete();

		if (Request::ajax())
		{
			return json_encode(array('result' => 'success' ));
		}
		else {
		// Redirect to the assets management page
			return Redirect::to('admin/assets')->with('success', Lang::get('admin/assets/message.delete.success'));
		}
	}

	public function file($id=null, $token=null)
	{

		if (is_numeric($id)) {
			$asset = Asset::where('id', '=', $id)->firstOrFail();
		}
		else{
			$asset = Asset::where('alphaID', '=', $id)->firstOrFail();
		}

		/******************** PERMISSIONS ***************************/
		$permissions = json_decode($asset->permissions);

		if ($permissions->public == 0) {
			return;
		}

		// if ($permissions->must_be_logged_in == 1) {
		// 	if (Sentry::check()) {
		// 		Session::set('redirect', Request::url());
		// 		die("call filter");
		// 		Parent::beforeFilter('cas-login', array());
		// 	}

		// }
		/******************** PERMISSIONS ***************************/

		$path = Config::get('settings.media-path');

		switch ($asset->type) {
			case 'video':
			$ext = "mp4";
			break;
			case 'audio':
			$ext = "mp3";
			break;
			default:
			$ext = $asset->original_ext;
			break;
		}
		$file = base_path() . "/" . $path . "/" . $asset->alphaID.  '.' . $ext;
		$mime = Mimes::getMimes($ext);

		if(file_exists($file)){
			$filesize = filesize($file);
		}

		if($id && $token == "download"){
			if ($permissions->can_download == 0) {
				return View::make('player.no_download');
			}


			$filename = preg_replace("/[^A-Za-z0-9 ]/", '', Str::snake(Str::lower($asset->title)));
			$filename = preg_replace("/\s/", '_', $filename.'.'.$ext);

			header("Content-Type: application/octet-stream");
			header("Content-Transfer-Encoding: Binary");
			header("Content-Disposition: attachment; filename=" . $filename);
			echo readfile($file);
			return;
		}

		if (is_file($file)){
			header("Content-type:". $mime);
			header("Cache-Control: public");
			header("Content-length: " . filesize($file));
			$this->rangeDownload($file);
			// readfile($file);

		}
	}

	function rangeDownload($file){
		$fp = @fopen($file, 'rb');

		$size   = filesize($file);
		$length = $size;
		$start  = 0;
		$end    = $size - 1;


		header("Accept-Ranges: 0-$length");


		if (isset($_SERVER['HTTP_RANGE'])){
			$c_start = $start;
			$c_end   = $end;
			list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
			if (strpos($range, ',') !== false){
				header('HTTP/1.1 416 Requested Range Not Satisfiable');
				header("Content-Range: bytes $start-$end/$size");
				exit;
			}

			if ($range{0} == '-'){
				$c_start = $size - substr($range, 1);
			} else {
				$range  = explode('-', $range);
				$c_start = $range[0];
				$c_end   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
			}

			$c_end = ($c_end > $end) ? $end : $c_end;

			if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size){
				header('HTTP/1.1 416 Requested Range Not Satisfiable');
				header("Content-Range: bytes $start-$end/$size");
				exit;
			}

			$start  = $c_start;
			$end    = $c_end;
			$length = $end - $start + 1;
			fseek($fp, $start);
			header('HTTP/1.1 206 Partial Content');

		}
		header("Content-Range: bytes $start-$end/$size");
		header("Content-Length: $length");

		$buffer = 1024 * 8;
		while(!feof($fp) && ($p = ftell($fp)) <= $end){
			if ($p + $buffer > $end){
				$buffer = $end - $p + 1;
			}
			set_time_limit(0);
			echo fread($fp, $buffer);
			flush();
		}

		fclose($fp);
	}

}
