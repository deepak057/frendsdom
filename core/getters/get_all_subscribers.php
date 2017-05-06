<?php

//get "Hobbies" class
include(get_module_path("hobbies".DS."hobbies.php"));

$hb=new hobbies();

echo json_encode(array(

"title"=>"People who like ".hobby_title($_REQUEST['h_id']),
"content"=>$hb->all_subscribers_view($_REQUEST['h_id'],100,array(uid())),

));


?>