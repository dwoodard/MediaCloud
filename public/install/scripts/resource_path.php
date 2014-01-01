<?php
/*
*  _____                                    _____      _   _
* |  __ \                                  |  __ \    | | | |
* | |__) |___  ___  ___  _   _ _ __ ___ ___| |__) |_ _| |_| |__
* |  _  // _ \/ __|/ _ \| | | | '__/ __/ _ \  ___/ _` | __| '_ \
* | | \ \  __/\__ \ (_) | |_| | | | (_|  __/ |  | (_| | |_| | | |
* |_|  \_\___||___/\___/ \__,_|_|  \___\___|_|   \__,_|\__|_| |_|
*
*/

if (!$_POST || !$project_root_path) {
	die("missing Data");
}





$resource_path = $project_root_path.'/'. $_POST['media-path'];

$original = $resource_path . '/original';


if (!file_exists($resource_path) and !is_dir($resource_path)) {
  $oldmask = umask(0);
  mkdir($resource_path,0777);
  umask($oldmask);
}


if (!file_exists($original) and !is_dir($original)) {
  
  $oldmask = umask(0);
  mkdir($original,0777);
  umask($oldmask);
}




 ?>
