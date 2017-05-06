<?php

include("environment.php");
check_auth();

if(!empty($_POST['return_type']))
{
	
//array containing all expected feedback values
$feedbacks=array("like","dislike","love","hate","stupid","awesom","best");

//displaying feedback statistics
get_feedback_statistics("feedbackonwebsite","feedback",$feedbacks,htmlentities(trim($_POST['return_type'])),$feedback_to_website);
}

else
{
header('location:home.php');
}
?>