<?php


//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['ps_movies_db']);

//save movie thumb locally
//$thumb_url=save_API_images($GLOBALS['movie_api_pic_base'].$_REQUEST['poster_id'],$GLOBALS['tmdb_dir']);

$thumb_url=$GLOBALS['movie_api_pic_base'].$_REQUEST['poster_id'];

//save movie details
if($mysqli->query("insert into movies (`movie_id`,`title`,`pic_url`,`release_date`,`vote`,`created_by`,`created`) values ('{$_REQUEST['m_id']}','".$mysqli->real_escape_string($_REQUEST['title'])."','{$thumb_url}','".get_date_time($_REQUEST['release_date'])."',{$_REQUEST['vote']},{$_SESSION["userid"]},'".get_date_time()."')"))
echo $_REQUEST['m_id'];


else echo "failed";


?>