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

		// die(var_dump($assets));
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
		// $asset->transcoded_url		= e(Input::get('transcoded_url'));
		// $asset->thumbnail_url		= e(Input::get('thumbnail_url'));
		// $asset->url					= e(Input::get('url'));
		$asset->type				= e(Input::get('type'));
		$asset->status				= e(Input::get('status'));
		// $asset->tags				= e(Input::get('tags'));
		// $asset->views				= e(Input::get('views'));
		// $asset->last_viewed			= e(Input::get('last_viewed'));
		// $asset->created_at			= e(Input::get('created_at'));
		// $asset->updated_at			= e(Input::get('updated_at'));



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
			return Redirect::to('admin/assets')->with('error', Lang::get('admin/assets/message.not_found'));
		}

		//Check CPA if asset exsists
		//Remove pivot asset
		// Delete the asset
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
	function readfile_chunked($filename,$retbytes=true) {
   $chunksize = 1*(1024*1024); // how many bytes per chunk
   $buffer = '';
   $cnt =0;
   // $handle = fopen($filename, 'rb');
   $handle = fopen($filename, 'rb');
   if ($handle === false) {
   	return false;
   }
   while (!feof($handle)) {
   	$buffer = fread($handle, $chunksize);
   	echo $buffer;
   	ob_flush();
   	flush();
   	if ($retbytes) {
   		$cnt += strlen($buffer);
   	}
   }
   $status = fclose($handle);
   if ($retbytes && $status) {
       return $cnt; // return num. bytes delivered like readfile() does.
   }
   return $status;

}


function rangeDownload($file){
	$fp = @fopen($file, 'rb');

        $size   = filesize($file); // File size
        $length = $size;           // Content length
        $start  = 0;               // Start byte
        $end    = $size - 1;       // End byte
        // Now that we've gotten so far without errors we send the accept range header
        /* At the moment we only support single ranges.
         * Multiple ranges requires some more work to ensure it works correctly
         * and comply with the spesifications: http://www.w3.org/Protocols/rfc2616/rfc2616-sec19.html#sec19.2
         *
         * Multirange support annouces itself with:
         * header('Accept-Ranges: bytes');
         *
         * Multirange content must be sent with multipart/byteranges mediatype,
         * (mediatype = mimetype)
         * as well as a boundry header to indicate the various chunks of data.
         */
        header("Accept-Ranges: 0-$length");
        // header('Accept-Ranges: bytes');
        // multipart/byteranges
        // http://www.w3.org/Protocols/rfc2616/rfc2616-sec19.html#sec19.2
        if (isset($_SERVER['HTTP_RANGE'])){
        	$c_start = $start;
        	$c_end   = $end;

            // Extract the range string
        	list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
            // Make sure the client hasn't sent us a multibyte range
        	if (strpos($range, ',') !== false){
                // (?) Shoud this be issued here, or should the first
                // range be used? Or should the header be ignored and
                // we output the whole content?
        		header('HTTP/1.1 416 Requested Range Not Satisfiable');
        		header("Content-Range: bytes $start-$end/$size");
                // (?) Echo some info to the client?
        		exit;
            } // fim do if
            // If the range starts with an '-' we start from the beginning
            // If not, we forward the file pointer
            // And make sure to get the end byte if spesified
            if ($range{0} == '-'){
                // The n-number of the last bytes is requested
            	$c_start = $size - substr($range, 1);
            } else {
            	$range  = explode('-', $range);
            	$c_start = $range[0];
            	$c_end   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
            } // fim do if
            /* Check the range and make sure it's treated according to the specs.
             * http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
             */
            // End bytes can not be larger than $end.
            $c_end = ($c_end > $end) ? $end : $c_end;
            // Validate the requested range and return an error if it's not correct.
            if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size){
            	header('HTTP/1.1 416 Requested Range Not Satisfiable');
            	header("Content-Range: bytes $start-$end/$size");
                // (?) Echo some info to the client?
            	exit;
            } // fim do if

            $start  = $c_start;
            $end    = $c_end;
            $length = $end - $start + 1; // Calculate new content length
            fseek($fp, $start);
            header('HTTP/1.1 206 Partial Content');
        } // fim do if

        // Notify the client the byte range we'll be outputting
        header("Content-Range: bytes $start-$end/$size");
        header("Content-Length: $length");

        // Start buffered download
        $buffer = 1024 * 8;
        while(!feof($fp) && ($p = ftell($fp)) <= $end){
        	if ($p + $buffer > $end){
                // In case we're only outputtin a chunk, make sure we don't
                // read past the length
        		$buffer = $end - $p + 1;
            } // fim do if

            set_time_limit(0); // Reset time limit for big files
            echo fread($fp, $buffer);
            flush(); // Free up memory. Otherwise large files will trigger PHP's memory limit.
        } // fim do while

        fclose($fp);
    } // fim do function



    public function file($alphaID)
    {
		// echo '?good permissions?<br>';


    	$asset = Asset::where('alphaID', '=', $alphaID)->firstOrFail();
    	$path = Config::get('settings.media-path');
    	$ext = 'mp4';
    	$file = base_path(). "/" . $path . "/" . $alphaID.  '.' . $ext;
    	$filesize = filesize($file);
    	$mime = Mimes::getMimes($ext);



    	if (is_file($file)){
    		header('Content-Type:'. $mime);
			if (isset($_SERVER['HTTP_RANGE'])){ // do it for any device that supports byte-ranges not only iPhone
				$this->rangeDownload($file);
			} else {
				header("Content-length: " . filesize($file));
				readfile($file);
			}
		}



		// try {
		// 	$asset = Asset::where('alphaID', '=', $alphaID)->firstOrFail();
		// }
		// catch (ModelNotFoundException $e) {
		// 	return Response::make('Sorry, The file: '.$alphaID.' doesn\'t seem to exsist', 404);
		// }

		// if ($item == "original" && $asset->type == "video" || $item == "original" && $asset->type == "audio") {
			// $path = Config::get('settings.media-path-original');
		// }
		// else{
		// 	$path = Config::get('settings.media-path');
		// }

		// if($item == "original"){
		// 	$ext = $asset->original_ext;
		// }
		// else{
		// 	switch ($asset->type) {
		// 		case 'video':
		// 			$ext = 'mp4';
		// 			break;
		// 		case 'audio':
		// 			$ext = 'mp3';
		// 			break;
		// 		default:
		// 			$ext = $asset->original_ext;
		// 			break;
		// 	}
		// }

		// switch ($item) {
		// 	case 'thumb':
		// 	$file = base_path(). "/" . $path . "/" . $alphaID.  "-thumb.jpg";
		// 	$ext = 'jpg';
		// 	break;

		// 	default:
		// 		$file = base_path(). "/" . $path . "/" . $alphaID.  '.' . $ext;
		// 	break;
		// }

		// // echo $file .  ' - - - -  ' . Mimes::getMimes($ext) . ' - - - -  ' .filesize($file) . '  --- ';
		// // die();

		// $fm=@fopen($file,'rb');
		// if(!$fm) {
		// 	// You can also redirect here
		// 	header ("HTTP/1.0 404 Not Found");
		// 	die();
		// }

		// $size=filesize($file);

		// $begin=0;
		// $end=$size;


		// if(isset($_SERVER['HTTP_RANGE'])) {
		// 	if(preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER['HTTP_RANGE'], $matches)) {
		// 		$begin=intval($matches[0]);
		// 		if(!empty($matches[1])) {
		// 			$end=intval($matches[1]);
		// 		}
		// 	}
		// }

		// if($begin>0||$end<$size)
		// 	header('HTTP/1.0 206 Partial Content');
		// else
		// 	header('HTTP/1.0 200 OK');

		// header('Content-Type:'. Mimes::getMimes($ext));
		// header('Accept-Ranges: bytes');
		// header('Content-Length:'.($end-$begin));
		// header("Content-Disposition: inline;");
		// header("Content-Range: bytes $begin-$end/$size");
		// header("Content-Transfer-Encoding: binary\n");
		// header('Connection: close');

		// $cur=$begin;
		// fseek($fm,$begin,0);

		// while(!feof($fm)&&$cur<$end&&(connection_status()==0))
		// 	{ print fread($fm,min(1024*16,$end-$cur));
		// 		$cur+=1024*16;
		// 		usleep(1000);
		// 	}
		// die();





	}



}
