<?php

# skeleton for a proper PHP program

error_reporting(E_ALL);
date_default_timezone_set('America/New_York');

define("EXEC_PATH", dirname(__FILE__)); # program resides at EXEC_PATH (const)

# $argv and $argc:

$pgmname = $argv[0]; # this program's name
$logname = str_ireplace(".php", ".log", $pgmname);

if ($argc > 1) {     # means we have some args passed to us
    $arg1 = argv[1]; #
    # etc...
}

# do this when logging:
$log = fopen($logname, "a"); # use "w" if we want a fresh log file
fprintf($log, date('Y-m-d H:i:s ') . "\n");

# EOF: