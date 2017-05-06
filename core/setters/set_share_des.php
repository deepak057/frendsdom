<?php

//get required values

$des=trim($_REQUEST['value']);

/*Get share id*/

$share_id=$_REQUEST['id'];
$share_id=explode("-",$share_id);
$share_id=$share_id[1];

//update description
update_entity("sboxofuser".uid(),"share_id",$share_id,"share_data",addslashes($des),$GLOBALS['share_box_db']);

echo text($des);

?>