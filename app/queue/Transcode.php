<?php

class Transcode {

    function fire($job, $data) {
        $asset = Asset::find($data['asset_id']);



        $originalFilename =  $asset->alphaID . '.'. $asset->original_ext;
        $filename =  $asset->alphaID;
        $filenameThumb =  $asset->alphaID."-thumb.jpg";

        $mediaPathOriginal = base_path(). "/" . Config::get('settings.media-path-original');
        $mediaPath = base_path(). "/" . Config::get('settings.media-path');

        $ofp = "$mediaPathOriginal/$originalFilename";



        File::append(storage_path() . '/logs/queue.txt', $asset->id . '----' . $ofp .'----' . "$mediaPath/$filenameThumb" .'----' . "$mediaPath/$filename.mp4" . PHP_EOL);





        $asset->status = "transcoded:start";
        $asset->save();

        switch($asset->type)
        {
            case 'video':

                exec("sudo ffmpeg -i $ofp -ss 5 $mediaPath/$filenameThumb", $out, $return);

                 switch($asset->original_ext){
                    case "mov":
                        exec("sudo ffmpeg -i $ofp -vcodec copy -acodec aac -strict experimental -ac 2 -ar 44100 -ab 192k $mediaPath/$filename.mp4", $out, $return);
                    break;

                    case "flv":
                        exec("sudo ffmpeg -i $ofp -ar 44100 -ab 192k $mediaPath/$filename.mp4", $out, $return);
                    break;

                    case default:
                        exec("sudo ffmpeg -i $ofp $mediaPath/$filename.mp4", $out, $return);
                    break;
                }



                $asset->filepath = $transcode_dir;
                 
                break;

            case 'audio':
                exec("sudo ffmpeg -i $ofp $mediaPathOriginal/$filename.mp3", $out, $return );
                 
                break;
        }

        $asset->status = "transcoded:complete";
        $asset->save();


        $job->delete();

    }

}
 ?>