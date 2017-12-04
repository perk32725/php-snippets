<?php
/*
 * remove a file, if it's too old:
 */

#------------------------------------------------------------------------------
# datedFileRM($destPath, $days)
#------------------------------------------------------------------------------
function datedFileRm($destPath, $days) {
    echo date('Y-m-d H:i:s ') . "Removing files from $destPath $days old or older:\n";
    $dir = opendir($destPath);
    while (false !== ($file = readdir($dir))) {
        # filemtime() is file date; filectime() is inode file date
        $ftime = filemtime("$destPath/$file"); # get file time
        $stime = date('Ymd', $ftime);          # get string version of $ftime
        if ($stime <= date('Ymd', strtotime("-$days days")) && $file != "." && $file != "..") {
            unlink("$destPath/$file");
            echo date('Y-m-d H:i:s ') . "$destPath/$file removed.\n";
        }
    }
    closedir($dir);
}

