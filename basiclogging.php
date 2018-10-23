<?php

#------------------------------------------------------------------------------
# logmsg()- basic logging function
#------------------------------------------------------------------------------
function logmsg($msg) {
    $logfile = ""; # can be set to "", null, STDOUT, STDERR, or a filename
    if ($logfile == ""): return; endif;
    file_put_contents($logfile, date('Y-m-d H:i:s ') . "$msg\n", FILE_APPEND);
}

# EOF:
