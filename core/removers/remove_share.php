<?php

if(!empty($_REQUEST['share_id'])){

//get current user's share pics directory
$pic_dir=get_share_pic_dir(uid());

//remove all the pics belonging to this share
foreach (glob($pic_dir."/".$_REQUEST['share_id']."*.*") as $filename) {
unlink($filename);
}

//update database
delete_row("sboxofuser".uid(),"share_id",$_REQUEST['share_id'],$GLOBALS['share_box_db']);

//confirm success
echo "1";

}

?>