<?php

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['ps_videos_db']);

//save video thumbnail locally
$thumb_url=save_API_images($_REQUEST['pic_url'],$GLOBALS['youtube_dir']);


//save video details
if($mysqli->query("insert into videos (`video_id`,`published`,`description`,`views`,`created`,`created_by`,`title`,`pic_url`) values ('{$_REQUEST['video_id']}','".get_date_time($_REQUEST['published'])."','".$mysqli->real_escape_string($_REQUEST['description'])."',{$_REQUEST['views']},'".get_date_time()."',{$_SESSION["userid"]},'".$mysqli->real_escape_string($_REQUEST['title'])."','{$thumb_url}') ON DUPLICATE KEY UPDATE `views`='{$_REQUEST['views']}'"))
echo $_REQUEST['video_id'];

else echo "failed";


?>