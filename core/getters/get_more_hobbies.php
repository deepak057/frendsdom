<?php

//get "Hobbies" class
include(get_module_path("hobbies".DS."hobbies.php"));

//results per page
$total=10;

$hb=new hobbies();
$hb->hobbies_stack(uid(),$_REQUEST['offset']*$total,$total);


?>