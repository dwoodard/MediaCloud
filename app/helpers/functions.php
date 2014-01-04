<?php
function humanFileSize($size,$unit="") {
  if( (!$unit && $size >= 1<<30) || $unit == " GB")
    return number_format($size/(1<<30),2)." GB";
  if( (!$unit && $size >= 1<<20) || $unit == " MB")
    return number_format($size/(1<<20),2)." MB";
  if( (!$unit && $size >= 1<<10) || $unit == " KB")
    return number_format($size/(1<<10),2)." KB";
  return number_format($size)." bytes";
}

function normalizePath($path){
    $parts = array();// Array to build a new path from the good parts
    $path = str_replace('\\', '/', $path);// Replace backslashes with forwardslashes
    $path = preg_replace('/\/+/', '/', $path);// Combine multiple slashes into a single slash
    $segments = explode('/', $path);// Collect path segments
    $test = '';// Initialize testing variable
    foreach($segments as $segment){
        if($segment != '.'){
            $test = array_pop($parts);
            if(is_null($test))
                $parts[] = $segment;
            else if($segment == '..'){
                if($test == '..')
                    $parts[] = $test;
                if($test == '..' || $test == '')
                    $parts[] = $segment;
            }
            else{
                $parts[] = $test;
                $parts[] = $segment;
            }
        }
    }
    return implode('/', $parts);
}

function recursiveChmod ($path, $filePerm=0644, $dirPerm=0777) {
    // Check if the path exists
    if (!file_exists($path)) {
        return(false);
    }

    // See whether this is a file
    if (is_file($path)) {
        // Chmod the file with our given filepermissions
        chmod($path, $filePerm);

        // If this is a directory...
    } elseif (is_dir($path)) {
        // Then get an array of the contents
        $foldersAndFiles = scandir($path);

        // Remove "." and ".." from the list
        $entries = array_slice($foldersAndFiles, 2);

        // Parse every result...
        foreach ($entries as $entry) {
            // And call this function again recursively, with the same permissions
            recursiveChmod($path."/".$entry, $filePerm, $dirPerm);
        }

        // When we are done with the contents of the directory, we chmod the directory itself
        chmod($path, $dirPerm);
    }

    // Everything seemed to work out well, return true
    return(true);
}


function read_file($file)
{
    if( !is_file($file) )
    {
        trigger_error('File ' . $file . ' is unexistant or not a regular file', E_USER_WARNING);
        return false;
    }
    $size = filesize($file);
    $file = fopen($file, 'rb');
    for($i = 0; $i < $size; $i += 8192) // This means "8 Kb", seems to be a limitation in fread
    {
        echo fread($file, 8192);
        flush();
    }
    return;
}


