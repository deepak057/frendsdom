<?php

//path to cover directory of current user
$cover_dir=cover_pic_path($_SESSION['userid']);

//delete all the images that already exist in "cover" directory
delete_all_images($cover_dir);

//update database
update_entity("userdata","id",$_SESSION['userid'],"cover_pic",NULL);

//confirm success
echo json_encode(array("success"=>true,"pic_path"=>cover_pic($_SESSION['userid'])));

?>