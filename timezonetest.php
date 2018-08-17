<?php
$tz = ini_get('date.timezone');
echo "\$tz = '$tz'\n";
$tz = date_default_timezone_get();
echo "\$tz = '$tz'\n";
date_default_timezone_set('America/New_York');
$tz = date_default_timezone_get();
echo "\$tz = '$tz'\n";

?>
