<?php

include("environment.php");
check_auth();

if(!empty($_POST['p_id']))
{

if(delete_row("posts_record_of_user{$_SESSION['userid']}","post_id",$_POST['p_id'],$posts_db)){

//deleting this post from all the lu's relation's status views
delete_posts_record($_SESSION['userid'],$_POST['p_id']);

//confirming success
echo "1";

}
else echo "0";

}
else
{
header('location:home.php');
}
?>