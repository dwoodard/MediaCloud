<?php

use Illuminate\Console\Command;
use MC\Services\UploadCreatorService;
use MC\Validators\UploadValidator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProcessCaptureDirectoryCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'process:capture';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process the Capture video from extron.';

    /**
     * Create a new command instance.
     *
     * @param UploadCreatorService $uploadCreator
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {

        // Process Capture directory
        $videos = File::directories(base_path() . '/captures');

        // get of Count directory count($videos)
        // loop dir
        foreach ($videos as $video) {
            $path_parts = pathinfo(realpath($video));
            $name = $path_parts['basename'];
            $video_data = File::get($video . '/' . $name . '.json');
            // not real json file... fix it
            $video_data = str_replace(["var manifest ="], "", $video_data);
            // convert to obj
            $video_data = json_decode($video_data);

            // take name of video and get username's id & title set vars
            $username = $video_data->package->metadata->{'dc:creator'};
            // dd($username);
            $user = User::where('username', '=', $username)->get()->first();
            $title = $video_data->package->metadata->{'dc:title'};
            $fileName = $video_data->package->streams[0]->recordings[0]->name;
            $file = realpath($video) . '/' . $fileName;
            // echo (" - ".$file . PHP_EOL );
            // dd(array($file, $fileName, $title));
            $uploadedFile = new UploadedFile($file, $fileName, 'video/mp4', filesize($file), 0, true);
            // dd($uploadedFile);

            $uploadCreator = new UploadCreatorService(new UploadValidator());

            if ($user == null) {
                File::move($video, base_path() . '/tmp/' . $name);
            } else {
                $uploadCreator->make($user->id, $uploadedFile, false);
                File::deleteDirectory($video, false);
            }


        }


    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
//    protected function getArguments()
//    {
//        return array(
//            array('example', InputArgument::REQUIRED, 'An example argument.'),
//        );
//    }

    /**
     * Get the console command options.
     *
     * @return array
     */
//    protected function getOptions()
//    {
//        return array(
//            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
//        );
//    }

}
