<?php

include("environment.php");
check_auth();

if(!empty($_POST['table']) && !empty($_POST['index']))
{

if(entity_value($_POST['table'],"fromid","comment_index",$_POST['index'],$comment_on_website)!=$_SESSION['userid'])
die("Error: Failed to delete comment");
else if(delete_row($_POST['table'],"comment_index",$_POST['index'],$comment_on_website))
echo "1";
else echo "0";
}
else
{
header('location:home.php');
}
?>