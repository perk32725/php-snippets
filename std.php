<?php

# skeleton for a proper PHP program

error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$log = fopen("program.log", "a"); # use "w" if we want a fresh log file

# do this when logging:
fprintf($log, date('Y-m-d H:i:s ') . "\n");

# EOF:
