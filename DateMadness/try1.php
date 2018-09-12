#!/usr/bin/php
<?php

$IAM = basename($argv[0]);
if (! isset($argv[1])) {
  echo "usage: $IAM date\n";
  return 1;
}

$input = $argv[1];

if (strlen($input) == 6) {
  $newinput = "20" . $input;
} else {
  $newinput = $input;
}

echo "Week " . date("W", strtotime($newinput)) . "\n";

?>
