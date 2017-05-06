<?php

include("environment.php");
check_auth();

header('content-type:audio/wav');
echo entity_value("soundclipsofuser{$_SESSION['id']}","data","set1","yes",$soundclips_db);

?>