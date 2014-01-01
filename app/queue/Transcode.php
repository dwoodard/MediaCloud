<?php

namespace queue;

use Monolog\Logger;
use Monolog\Handler\NullHandler;

class Transcode {

    public function fire($job, $data)
    {
        set_time_limit(0);
        // Process the job received from the queue

        // Expects:
        // $data['filepath']
        // $data['type']
        // $data['asset_id']


        $asset = Asset::find($data['asset_id']);
        if(!$asset)
        {
            $job->delete();
        }
        
        $filepath = normalizePath($data['filepath']);


        $public_path = public_path().'/users/'.$asset->user->username ;
        ///webapps/media_weber_edu/public/users/dustinwoodard


        $transcode_path = explode($asset->user->username, $asset->transcoded_url);
        $transcode_path  = $transcode_path[1] ;
        // /video/transcoded/3-fbbbc-1.mp4

        if($asset->type == "video"){
            $transcode_thumb_path = explode($asset->user->username, $asset->thumbnail_url);
            $transcode_thumb_path  = $transcode_thumb_path[1];
            // /video/transcoded/thumb/3-fbbbc-1.jpg

            $transcode_thumb_dir = normalizePath($public_path.$transcode_thumb_path);
            // /webapps/media_weber_edu/public/users/dustinwoodard/video/transcoded/thumb/3-fbbbc-1.jpg
        }


        $transcode_dir = normalizePath($public_path.$transcode_path);
        ///webapps/media_weber_edu/public/users/dustinwoodard/video/transcoded/3-fbbbc-1.mp4



        $filepart = pathinfo(basename($data['filepath']));
        $filename = $filepart['filename'];
        $ext = $filepart['extension'];
        $filenameWithExt = basename($data['filepath']);


        // Create a logger
        $logger = new Logger('TranscodeLogger');
        $logger->pushHandler(new NullHandler());


        $asset->status = "transcoded:start";
        $asset->save();

        switch($asset->type)
        {
            case 'video':
//                var_dump(realpath($public_path));
//                var_dump(normalizePath($filepath));
//                var_dump($public_path.$transcode_path);
//                var_dump(normalizePath($public_path.$transcode_path));
//                var_dump(normalizePath($transcode_dir));
//                var_dump(normalizePath($transcode_thumb_dir));
//                die();
                exec("sudo ffmpeg -i $filepath -ss 5 $transcode_thumb_dir", $out, $return);
                // Log::info('thumb --' . "sudo ffmpeg -i $asset->filepath -ss 5 $transcode_thumb_dir". "-- $return");

                exec("sudo ffmpeg -i $filepath $transcode_dir", $out, $return);
                // Log::info('video --' . "sudo ffmpeg -i $asset->filepath $transcode_dir" . "-- $return");


                $asset->filepath = $transcode_dir;
                $asset->status = "transcoded:complete";
                $asset->save();
                break;

            case 'audio':
                exec("sudo ffmpeg -i $filepath $transcode_dir", $out, $return );
                // Log::info('audio --' . "sudo ffmpeg -i $asset->filepath $transcode_dir" . "-- $return");
                $asset->status = "transcoded:complete";
                $asset->save();
                break;
        }

        chmod($transcode_dir,0777);
       // Log::info($output.PHP_EOL);

        $job->delete();
    }

}
