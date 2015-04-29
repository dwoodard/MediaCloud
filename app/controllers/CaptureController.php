<?php
use Illuminate\Filesystem\Filesystem;
use MC\Exceptions\UploadException;
use MC\Services\UploadCreatorService;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CaptureController extends BaseController
{

    public function __construct(AssetRepository $asset, UploadCreatorService $uploadCreator) {
        $this->asset = $asset;
        $this->uploadCreator = $uploadCreator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data = [];
        $captureAgents = CaptureAgent::all();
        // return $calendarEvents;
        return View::make('backend/capture/index', compact('captureAgents'));
    }

    /**
     * Store a newly created test123 in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($data = Input::all(), CaptureAgent::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        CaptureAgent::create($data);

        // return Redirect::route('test123s.index');
    }

    public function addEvent() {
        // validate data

        return CalendarEvent::create(Input::all());
    }

    public function updateEvent($id) {
        // validate data

        $event = CalendarEvent::find($id);
        if ($event) {
            $event->update(Input::all());
            return $event;
        }
        return json_encode("event does not exist");

        // return CalendarEvent::create(Input::all());
    }

    public function deleteEvent($id) {
        $event = CalendarEvent::find($id);
        if ($event) {
            $event->delete();
            return $event;
        }
        return json_encode("event does not exist");

    }

    public function addCaptureAgent() {

        if (Request::ajax())
        {
            $ca = new CaptureAgent;
            $ca->ip          = Input::get('ip');
            $ca->location    = Input::get('location');
            $ca->save();
            return $ca->toJson();
        }
        return "not ajax";

    }

    public function get_devices($id) {
        $this->layout = "";

        return CaptureAgent::where('id', '=', $id)->get();
    }



    public function kaltura($token, $entryId) {

        $filePath = public_path() . "/kaltura/";
        $fileName = "$token.mp4";
        $file = $filePath . $fileName;

        if (!file_exists($file)) {
            return json_encode(array("status" => "no file", "where" => __FILE__ . ":" . __LINE__));
        }

        $user = User::where("username", "=", $entryId)->get()->first();
        $uploadedFile = new UploadedFile($file, $fileName, 'video/mp4', filesize($file), 0, true);

        File::append(storage_path() . '/logs/kaltura_capture.txt', "kaltura" . " - " . $token . " " . $entryId . PHP_EOL);
        try {
            $this->uploadCreator->make($user->id, $uploadedFile);
        } catch (\MC\Exceptions\ValidationException $e) {
            return $e;
        } catch (FileException $e) {
            var_dump($e);
        }

        return;

    }


}