<?php
use Illuminate\Filesystem\Filesystem;

class CaptureController extends BaseController {

    protected $layout = 'frontend.layouts.default';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        return "index";

        // if(!Auth::check())
        // {
        //     return URL::to('/login');
        // }

        // $curl = new Curl();
        // $curl->create('https://media.weber.edu/api/schedule.php?username=gtuck'); //Add Auth::user()->username in place of gtuck
        // $curl->options(array(CURLOPT_SSL_VERIFYPEER => 0));

        // $schedules = json_decode($curl->execute());

//        var_dump();
//        var_dump($schedules);

//        var_dump(CaptureAgent::all());
        // $this->layout->title = "Capture";
        // $this->layout->content = View::make('capture.index')
        //     ->with('capture_agents', CaptureAgent::all())
        //     ->with('schedules', $schedules);
	}

    public function get_devices($id){
        $this->layout = "";

        return CaptureAgent::where('id','=',$id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store() {
        $this->layout = "";

        $capture = new Capture();
        $capture->duration = (int) Input::get('duration');
        $capture->userId = Auth::user()->id;
        $capture->save();

        $captureId = $capture->id;

        $data = new stdClass();
        $data->captureId = $captureId;
        $data->duration = $capture->duration;
        $data->userId = $capture->userId;
        echo json_encode((object) $data);
    }

    public function kaltura($token, $entryId){
        define('SITE_URL', $_SERVER['REQUEST_SCHEME']. "://" . $_SERVER['HTTP_HOST']);
        File::append(storage_path() . '/logs/kaltura_capture.txt', "kaltura" . " - " .SITE_URL. " - " . $token ." ". $entryId . PHP_EOL);
        return;

    }

    public function job($id){
        $capture = Capture::find($id);
        $jobs_path = public_path() . '/jobs/';
        $jobs_url = URL::to('/') . '/jobs/';
        $user = User::find($capture->userId);
        $file_path = $jobs_path . $id . '.webm';
        $file_url = $jobs_url . $id . '.webm';

       // echo $file_path;
       // die();
//        echo $file_url;

        if(!$user->username){
            return json_encode(array('status'=>'fail', 'description'=>'No username'));
        }

        if(!file_exists($file_path)){
            return json_encode(array('status'=>'fail', 'description'=>'File: ' . $file_path .' does not exist'));
        }

        //Convert file from capture to asset

        $path_to_user = public_path() . '/users/' . $user->username . '/';
        $url_to_user = URL::to('/') . '/users/'.$user->username.'/';


        //Todo: file name might need to be $asset_id-$alpha_id-$filename
        $filename = "capture-".date('m-d-Y-H-i-s', strtotime($capture->created_at));

//        echo "sudo ffmpeg -i $file " .$path_to_user. "video/transcoded/"."capture-".$id.".mp4";
//        echo ("sudo ffmpeg -i $file " .$path_to_user. "video/transcoded/".$filename.".mp4");



        $asset = new Asset();
        $asset->user_id = $user->id;
        $asset->filepath = $file_path;  //$path_to_user . 'jobs/' . $capture->id . '.webm'; //May not be needed
        $asset->filename = $filename.'.mp4';
        $asset->type= 'video';
        $asset->save();

        $asset_id = $asset->id;


        $asset_data = Asset::find($asset_id);
        $asset_data->title = $filename;
        //TODO: if alphaID is changed it needs to be changed on CaptureController also
        $encodedId = alphaID($asset_id, $to_num = false, $pad_up = 5, $passKey = null);
        $asset_data->alpha_id = $encodedId;
        $newFileName = "$asset_id-$encodedId-$filename";
        $asset_data->filename = $newFileName.'.mp4';
        $asset_data->transcoded_url =  $url_to_user.'video/transcoded/'. $newFileName.'.mp4';
        $asset_data->thumbnail_url = $url_to_user.'video/transcoded/thumb/'. $newFileName.'.jpg';
        $asset_data->status= 'uploaded';
        $asset_data->save();

        $transThumbDir = "$path_to_user/$asset->type/transcoded/thumb";

        $fs = new Filesystem();
        // Create Folders
        if(!$fs->exists($transThumbDir)){
            if (!mkdir($transThumbDir, 0777, true)) {
                die('Failed to create folders...');
            }
            chmod($transThumbDir, 0777);
        }




        Queue::push('Transcode', array('asset_id' => $asset_id, 'filepath' => $asset->filepath, 'type'=>$asset->type));






    }

}