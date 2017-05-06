<?php

//get "Hobbies" class
include(get_module_path("hobbies".DS."hobbies.php"));

$hb=new hobbies();
echo $hb->subscribers_view($_REQUEST['h_id'],10,array(uid()));


?>