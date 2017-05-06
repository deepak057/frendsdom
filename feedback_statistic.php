<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['return_type']))
{

//array containing all expected feedback values
$feedbacks=array("like","dislike","love","hate","stupid","awesom","likeminded","alterd","best");

//displaying feedback statistics
get_feedback_statistics("profilefeedback4user".$_POST['id'],"feedback1",$feedbacks,htmlentities(trim($_POST['return_type'])),$feedback_to_profile_db);
}

else
{
header('location:home.php');
}


?>