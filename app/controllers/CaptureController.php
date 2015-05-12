<?php
use Illuminate\Filesystem\Filesystem;
use MC\Exceptions\UploadException;
use MC\Services\UploadCreatorService;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CaptureController extends BaseController
{

    public function __construct(AssetRepository $asset, UploadCreatorService $uploadCreator)
    {
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

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        CaptureAgent::create($data);
        $this->writeICal();
    }

    public function updateEvent($id)
    {
        // validate data

        $event = CalendarEvent::find($id);
        if ($event) {
            $event->update(Input::all());
            $this->writeICal();
            return $event;
        }
        return json_encode("event does not exist");
    }

    public function writeICal()
    {
        //Capture Agents iCal file - events.ics
        $events = CalendarEvent::all();
//        return $events;
        $vCalendar = new \Eluceo\iCal\Component\Calendar(URL::to('/'));
        foreach ($events as $event) {
            $start = new Carbon\Carbon($event->start);
            $end = new \Carbon\Carbon($event->end);
            $user = User::find($event->user_id);
            // Create Event
            $vEvent = new \Eluceo\iCal\Component\Event();
            // Add Info
            $vEvent->setDtStart(new DateTime($start->setTimezone('UTC')))
                ->setDtEnd(new DateTime($end->setTimezone('UTC')))
                ->setLocation($event->location, $event->title)
                ->setorganizer($user->username)
                ->setSummary($event->title);
            $vCalendar->addComponent($vEvent);
        }
        // Add event to calendar
        File::put(base_path() . "/ics/events.ics", $vCalendar->render());
    }

    public function addEvent()
    {
        // validate data
        $data = CalendarEvent::create(Input::all());
        $this->writeICal();
        return $data;

    }

    public function deleteEvent($id)
    {
        $event = CalendarEvent::find($id);
        if ($event) {
            $event->delete();
            $this->writeICal();
            return $event;
        }
        return json_encode("event does not exist");

    }

    public function addCaptureAgent()
    {

        if (Request::ajax()) {
            $ca = new CaptureAgent;
            $ca->ip = Input::get('ip');
            $ca->location = Input::get('location');
            $ca->save();
            return $ca->toJson();
        }
        return "not ajax";

    }

    public function get_devices($id)
    {
        $this->layout = "";

        return CaptureAgent::where('id', '=', $id)->get();
    }

    public function kaltura($token, $entryId)
    {

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