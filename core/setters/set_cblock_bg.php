<?php

//update share's background color
update_entity("sboxofuser".uid(),"share_id",$_REQUEST['share_id'],"background",$_REQUEST['color'],$GLOBALS['share_box_db']);

//confirm success
echo "1";

?>