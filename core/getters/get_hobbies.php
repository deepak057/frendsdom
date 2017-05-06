<?php

//get "Hobbies" class
include(get_module_path("hobbies".DS."hobbies.php"));

$hb=new hobbies();
echo $hb->welcome_popup();


?>