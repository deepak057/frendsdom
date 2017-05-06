<?php

//get required values

$title=trim($_REQUEST['value']);

/*Get share id*/

$share_id=$_REQUEST['id'];
$share_id=explode("-",$share_id);
$share_id=$share_id[1];

//update title
update_entity("sboxofuser".uid(),"share_id",$share_id,"share_title",addslashes($title),$GLOBALS['share_box_db']);

echo text($title);

?>