<?php
use Illuminate\Filesystem\Filesystem;
use MC\Exceptions\UploadException;
use MC\Services\UploadCreatorService;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CaptureController extends BaseController {

    public function __construct(AssetRepository $asset, UploadCreatorService $uploadCreator) {
        $this->asset = $asset;
        $this->uploadCreator = $uploadCreator;
    }
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

        $filePath =  public_path() . "/kaltura/";
        $fileName = "$token.mp4";
        $file = $filePath.$fileName;

        if (!file_exists($file)) {
            return json_encode(array("status"=>"no file", "where"=>__FILE__.":".__LINE__));
        }

        $user = User::where("username","=", $entryId)->get()->first();
        $uploadedFile = new UploadedFile($file,$fileName,'video/mp4',filesize($file), 0, true);

        File::append(storage_path() . '/logs/kaltura_capture.txt', "kaltura" . " - " . $token ." ". $entryId . PHP_EOL);
        try{
            $this->uploadCreator->make($user->id, $uploadedFile);
        }
        catch(\MC\Exceptions\ValidationException $e){
            return $e;
        }
        catch(FileException $e){
            var_dump($e);

        }

        return;

    }

    

}