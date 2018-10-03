<?php
# --- basic logging function:
#------------------------------------------------------------------------------
# logmsg()
#------------------------------------------------------------------------------
$logfile = ""; # can be set to "", null, STDOUT, STDERR, or a filename

function logmsg($msg) {
    global $logfile;
    if ($logfile == ""): return; endif;
    file_put_contents($logfile, date('Y-m-d H:i:s ') . "$msg\n", FILE_APPEND);
}

# EOF:
