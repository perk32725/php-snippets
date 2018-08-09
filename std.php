<?php

# skeleton for a proper PHP program

error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
define("EXEC_PATH", dirname(__FILE__)); # program resides at EXEC_PATH (const)

$iAm      = basename(__FILE__);
$myPid    = getmypid();
$logfile  = null; # can be set to null, STDOUT, or STDERR
$childPid = 0;

# --- set logname to something reasonable:
$logname = "/var/log/" . str_replace(".php", ".log", $iAm);

if ($argc > 1) {     # means we have some args passed to us
    $arg1 = argv[1]; #
    # etc...
}

#------------------------------------
# standard logging function:
#------------------------------------
function stdlog($msg) {
    global $logfile;
    global $logname;
    global $myPid;

    if (!$logfile) {
        if (!($logfile = fopen($logname, "a"))) {
            fprintf(STDERR, date('Y-m-d H:i:s ') . "[$myPid] couldn't fopen() $logname, exiting\n");
            exit;
        }
    }

    fprintf($logfile, date('Y-m-d H:i:s ') . "[$myPid] $msg\n");
}

#-----------------------------------
# on SIGTERM, exit
#-----------------------------------
if (function_exists('pcntl_signal')) {
    function term_routine() {
        global $childPid;

        $status = 0;

        if ($childPid) {
            stdlog("posix_kill($childPid, SIGKILL)");
            posix_kill($childPid, SIGKILL);
            stdlog("waiting for child [$childPid]");
            pcntl_wait($status); # Protect against Zombie children
            stdlog("child process [$childPid] returned $status");
        }

        exit;
    }

    pcntl_signal(SIGTERM, 'term_routine');
}

#------------------------------------
# on exit, clean up the mess:
#------------------------------------
function exit_routine() {
    stdlog("(exit_routine())");
}

# --- register exit_routine to be run on shutdown:
register_shutdown_function('exit_routine');

# --- do a fork and exec:
if (function_exists('pcntl_fork')) {
    $childPid = pcntl_fork();
    if ($childPid == -1) {
        die('could not fork');
    } else if ($childPid == 0) { #  we are the child
        # build command, command array:
        $cmd = "COMMAND";
        $cmdarray[] = "OPTION1";
        $cmdarray[] = "OPTION2";
        # etc...

#    echo date('Y-m-d H:i:s ') . '[' . getmypid() . '] ' . "pcntl_exec($cmd, \$cmdarray)\n";
        stdlog("pcntl_exec($cmd, \$cmdarray)");
        var_dump($cmdarray);
        pcntl_exec($cmd, $cmdarray);
    }

# --- parent process continues:
#echo date('Y-m-d H:i:s ') . "[$myPid] waiting for child process [$childPid]\n";
    stdlog("waiting for child process [$childPid]");
    pcntl_wait($status); # Protect against Zombie children
    stdlog("child process [$childPid] returned $status");
    $childPid = 0;
}

# EOF:
