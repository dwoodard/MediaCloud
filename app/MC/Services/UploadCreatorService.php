<?php

namespace MC\Services;

use Asset;
use Config;
use User;
use Mimes;
use Queue;

use MC\Exceptions\ValidationException;
use MC\Validators\UploadValidator;

use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class UploadCreatorService
{


    protected $validator;

    public function __construct(UploadValidator $validator) {
        $this->validator = $validator;
    }

    public function make($userId, UploadedFile $file) {

        // Upload file

        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $filesize = $file->getClientSize();
        $filetype = Mimes::getMimes(strtolower($extension));

        $assetId = "";
        $attributes = array(
            "title"        => $filename,
            "original_ext" => $extension,
            "filename"     => $filename,
            "filesize"     => $filesize,
            "type"         => preg_replace('/(\w+)\/(.*)/', '${1}', $filetype),
            "status"       => "uploaded"
        );


        // If not a video or audio no need to transcode or save original out again.
        if ($attributes['type'] == "video" || $attributes['type'] == "audio") {
            $destinationPath = base_path() . "/" . Config::get('settings.media-path-original');
        } else {
            $destinationPath = base_path() . "/" . Config::get('settings.media-path');
        }

        // Save Asset if valid

        if ($this->validator->isValid($attributes)) {
            // Create a new asset
            $asset = new Asset;
            $asset->title = $attributes['title'];
            $asset->original_ext = $attributes['original_ext'];
            $asset->type = $attributes['type'];
            $asset->filesize = $attributes['filesize'];
            $asset->status = "uploaded";
            $asset->permissions = json_encode(array("can_download" => 1, "public" => 1, "must_be_logged_in" => 0));
            $asset->save();
            $assetId = $asset->id;

        } else {
            throw new ValidationException('Upload validation failed', $this->validator->getErrors());
        }

        // get assetId, call alphaId
        $alpha_out = alphaID($assetId, false);
        // $number_out = alphaID($alpha_out, true);

        // save filename as alphaId
        $asset->alphaID = $alpha_out;
        $asset->save();

        file_put_contents(storage_path() . '/logs/UploadCreatorService.txt', '----|'. $file->isValid().  '|-------------'. $file->getError()  .'------------' . $file->getPath() .'/'. $file->getFilename() .'------ '.$destinationPath ."/". $asset->alphaID. "." . $extension . PHP_EOL, FILE_APPEND);

        copy($file->getPath() .'/'. $file->getFilename(), $destinationPath ."/". $asset->alphaID. "." . $extension);
        unlink($file->getPath() .'/'. $file->getFilename());

       // $file->move($destinationPath, $asset->alphaID . "." . $extension);

        if ($asset->type == 'video' || $asset->type == 'audio') {
            // Queue::push('DoSomethingIntensive', array('asset_id' => $asset->id));
            Queue::push('Transcode', array('asset_id' => $asset->id));
        }


        // save asset_user table
        $user = User::find($userId);
        $user->assets()->attach($assetId);

        echo json_encode(array('user' => $user->toArray(), 'asset' => $asset->toArray()));
    }


}
