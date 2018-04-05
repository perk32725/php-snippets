<?php

/* 
 * This was taken from fixup.php (part of the MusicDB project)
 * Generate a PHP script to rename files with -temp-nnnnn.m4a
 * 
 */

if ($flag) {
  echo "cat <<SCRIPT >/tmp/tryme.php\n";
  echo "#!/usr/bin/php\n";
  echo "\n<?php\n";
  echo "# -- now rename those pesky temp file to their right names:\n";
  echo 'if (false === (\$newfilelist = scandir(' . "'$dirname'))) {\n";
  echo '  echo " *** COULDN\'T re-scandir(' . "'$dirname')\";\n";
  echo "  return 1;\n";
  echo "}\n";
  echo "\n";
  echo "chdir('$dirname');\n";
  echo '# -- process each file in given directory:' . "\n";
  echo 'for (\$i = 0; \$i < count(\$newfilelist); \$i++) {' . "\n";
  echo '  \$srcfile = \$newfilelist[\$i];' . "\n";
  echo "\n";
  echo '  if (! strstr(\$srcfile, \'-temp-\')) {' . "\n";
  echo '    continue; # don\'t want non-temp files' . "\n";
  echo '  }' . "\n";
  echo "\n";
  echo '  \$tgtfile = preg_replace(\'/-temp-.*.m4a/\', ".m4a", \$srcfile);' . "\n";
  echo '  echo "rename(\"\$srcfile\", \"\$tgtfile\")\n";' . "\n";
  echo '  rename("\$srcfile", "\$tgtfile");' . "\n";
  echo '}' . "\n";
  echo "\n";
  echo "chdir('../');\n";
  echo '?>' . "\n";
  echo "SCRIPT\n";
  echo "\n";
  echo "chmod +x /tmp/tryme.php\n";
  echo "/tmp/tryme.php\n";
  echo "\n";
}

