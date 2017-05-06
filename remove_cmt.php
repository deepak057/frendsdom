<?php

include("environment.php");
check_auth();

if(!empty($_POST['table']) && !empty($_POST['index']))
{

if(entity_value($_POST['table'],"fromid","comment_no",$_POST['index'],$comment_on_profile_db)!=$_SESSION['userid'])
die("Error: Failed to delete comment");
else if(delete_row($_POST['table'],"comment_no",$_POST['index'],$comment_on_profile_db))
echo "1";
else echo "failed";
}
else
{
header('location:home.php');
}
?>