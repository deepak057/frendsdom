<?php

include("environment.php");
check_auth();

if(!empty($_POST['p_id']) && !empty($_POST['cmnt_id']))
{

if(entity_value($_POST['p_id'],"fromid","comment_id",$_POST['cmnt_id'],$cmnt_on_posts_db)==$_SESSION["userid"])
{
if(delete_row($_POST['p_id'],"comment_id",$_POST['cmnt_id'],$cmnt_on_posts_db))
echo "1";
else echo "0";
}
else echo "0";
}

else 
{
header('location:home.php');
}

?>