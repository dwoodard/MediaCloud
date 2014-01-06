<?php

class Transcode {

	function fire($job, $data) {
		$asset = Asset::find($data['asset_id']);



		$originalFilename =  $asset->alphaID . '.'. $asset->original_ext;
		$filename =  $asset->alphaID;
		$filenameThumb =  $asset->alphaID."-thumb.jpg";

		$mediaPathOriginal = base_path(). "/" . Config::get('settings.media-path-original');
		$mediaPath = base_path(). "/" . Config::get('settings.media-path');

		$original = "$mediaPathOriginal/$originalFilename";



		File::append(storage_path() . '/logs/queue.txt', $asset->id . '--' . $asset->type .'--' . $original .'--' . "$mediaPath/$filenameThumb" .'--' . "$mediaPath/$filename.mp4" . PHP_EOL);





		$asset->status = "transcoded:start";
		$asset->save();

		switch($asset->type)
		{
			case 'video':

				exec("sudo ffmpeg -i $original -ss 5 $mediaPath/$filenameThumb", $out, $return);

				 switch($asset->original_ext){
					case 'mp4':
						exec("sudo cp $original $mediaPath/$filename.mp4", $out, $return);
					break;

					case "avi":
						exec("sudo ffmpeg -i $original -acodec aac -b:a 128k -vcodec libx264 -b:v 25000k -flags +aic+mv4 -strict experimental  $mediaPath/$filename.mp4", $out, $return);
					break;

					case "mv4":
						exec("sudo ffmpeg -i $original -vcodec libx264 -strict experimental $mediaPath/$filename.mp4", $out, $return);
					break;

					case "mov":
						exec("sudo ffmpeg -i $original -acodec aac -b:a 128k -vcodec libx264 -b:v 25000k -flags +aic+mv4 -strict experimental $mediaPath/$filename.mp4", $out, $return);
					break;

					case "webm":
						exec("sudo ffmpeg -fflags +genpts -i $original -r 24 $mediaPath/$filename.mp4", $out, $return);
					break;

					case "3gp":
						exec("sudo ffmpeg -i $original -crf 25.0 -vcodec libx264 -acodec libvo_aacenc -ar 48000 -b:a 160k -coder 1 -rc_lookahead 60 -threads 0 $mediaPath/$filename.mp4", $out, $return);
					break;

					case "flv":
						exec("sudo ffmpeg -i $original -ar 44100 -ab 192k $mediaPath/$filename.mp4", $out, $return);
					break;

					case "ts":
						exec("sudo ffmpeg -i $original -acodec aac -b:a 128k -vcodec libx264 -b:v 25000k -strict experimental $mediaPath/$filename.mp4", $out, $return);
					break;

					default:
						exec("sudo ffmpeg -i $original -vcodec libx264 -acodec libfaac -strict experimental $mediaPath/$filename.mp4", $out, $return);
					break;
				}

				break;

			case 'audio':

				switch($asset->original_ext){
					case 'mp3':
						exec("sudo cp $original $mediaPath/$filename.mp3", $out, $return);
						break;

					default:
						exec("sudo ffmpeg -i $original $mediaPathOriginal/$filename.mp3", $out, $return);
						$asset->status = "transcoded:complete";
					break;
				}
				break;
		}

		$asset->status = "transcoded:complete";
		$asset->save();


		$job->delete();

	}

}
 ?>