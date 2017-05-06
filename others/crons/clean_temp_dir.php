<?php

require('../../environment.php');

//path to directory that has to be removed
$path=HOME.'/'.$GLOBALS["mp_temp_pic_dir"];

//remove directory
removeDir($path);

echo "Directory Cleaned";

?>