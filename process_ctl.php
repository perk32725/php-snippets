<?php

#------------------------------------------------------------------------------
# createPID()-
# create a .pid file in /var/run, with given name and current PID
# Complains to stdout if file already exists and terminates program
#------------------------------------------------------------------------------
function createPID($filename) {
    $pidfile = "/var/run/" . basename($filename) . ".pid";
    if (file_exists($pidfile)) {
        print(date('Y-m-d h:i:s ') . __FUNCTION__ . "(): $pidfile exists. Script still running or terminated abnormally\n");
        exit;
    }

    $fh = fopen($pidfile, 'w') or die(date('Y-m-d h:i:s ') . __FUNCTION__ . "(): ERROR - Unable to create $pidfile\n");
    fwrite($fh, getmypid() . "\n");
    fclose($fh);
}

#------------------------------------------------------------------------------
# checkPID()-
# looks in /var/run for given filename with .pid extension
# Returns 1 if .pid file exists, or 0 if it does not.
#------------------------------------------------------------------------------
function checkPID($filename) {
    $pidfile = "/var/run/" . basename($filename) . ".pid";
    if (file_exists($pidfile)) {
        return 1;
    }
    return 0;
}

#------------------------------------------------------------------------------
# destroyPID()-
# removes .pid file in /var/run with given filename
#------------------------------------------------------------------------------
function destroyPID($filename) {
    $pidfile = "/var/run/" . basename($filename) . ".pid";
    if (file_exists($pidfile)) {
        unlink($pidfile) or die(date('Y-m-d h:i:s ') . __FUNCTION__ . "(): ERROR - Unable to remove $pidfile\n");
    }
}

#------------------------------------------------------------------------------
# 
#------------------------------------------------------------------------------
# EOF: