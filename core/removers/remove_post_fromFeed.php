<?php

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);

//remove post from logged-in user's status view
if($mysqli->query("delete from status_view_of_user{$_SESSION['userid']} where `post_id`='{$_REQUEST['p_id']}'"))
echo "1";
else echo "0";

?>