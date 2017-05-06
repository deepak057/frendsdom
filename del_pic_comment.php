<?php

include("environment.php");
check_auth();

if(!empty($_POST['pic_id']) && !empty($_POST['cmt_index']))
{

if(entity_value($_POST['pic_id'],"fromid","comment_index",$_POST['cmt_index'],$picdata_db)!=$_SESSION['userid'])
die("Error: Failed to delete comment");
else if(delete_row($_POST['pic_id'],"comment_index",$_POST['cmt_index'],$picdata_db))
echo "1";
else echo "failed";
}
else
{
header('location:home.php');
}
?>