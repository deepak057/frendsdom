<?php

include("environment.php");
check_auth();

if(!empty($_POST['return_type']) && !empty($_POST['p_id']))
{

//array containing all expected feedback values
$feedbacks=array("like","awesome","best");

//displaying feedback statistics
get_feedback_statistics($_POST['p_id'],"fback",$feedbacks,trim($_POST['return_type']),$fback_to_posts_db);
}

else
{
header('location:home.php');
}
?>