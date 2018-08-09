<?php

# --- for when things really go sideways:
function errHandler($errNo, $errStr, $errFile, $errLine) {
    $msg = "$errStr in $errFile on line $errLine";
    if ($errNo == E_NOTICE || $errNo == E_WARNING) {
        throw new ErrorException($msg, $errNo);
    } else {
        echo date('Y-m-d H:i:s ') . "$msg\n";
    }
}

set_error_handler('errHandler');

# EOF:
