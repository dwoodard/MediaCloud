<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessCaptureDirectory extends Command
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
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        if (!ISCLI) define('ISCLI', PHP_SAPI === 'cli');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        if (ISCLI) {
            //Process Capture directory
            $videos = File::directories(base_path() . '/capture');

            //get of Count directory count($videos)
            //loop dir
            foreach($videos as $video){
                echo $video['name'];
            }
            // get video out of each dir
            // take name of video and get username's id & title set vars
            // simulate an UploadCreatorService($userId, file)

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
