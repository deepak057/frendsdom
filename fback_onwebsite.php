<?php

include("environment.php");
check_auth();

if(!empty($_POST['fback']))
{

//array containing all expected feedback values
$feedbacks=array("like","dislike","love","hate","awesom","stupid","best");

//filtering the received data
$fback=htmlentities(trim($_POST['fback']));

//if the feedback retrieved either is not in above defined array or has value 'no' then delete the feedback data corresponding to associated id
if(!in_array($fback,$feedbacks) || $fback=="no")
{
if(!$con)die("Failed to connect to database");
mysql_select_db($feedback_to_website,$con);
if(mysql_query("delete from feedbackonwebsite where fromid='{$_SESSION['userid']}'"))
echo "1";
else echo "0";
}

else
{
if(!check_if_exists("feedbackonwebsite","fromid",$_SESSION['userid'],$feedback_to_website))
{
$mysqli=new mysqli($host,$db_user,$db_passwd,$feedback_to_website);
if($mysqli===false)
{
die("Could not connect to database");
}
if($mysqli->query("insert into feedbackonwebsite (fromid,feedback,when1) values ('{$_SESSION['userid']}','{$fback}','".date('Y-m-d H:i:s')."')"))
echo "1";
else echo "0";
}

else
{
if(!$con)
die("Failed to connect to database");
mysql_select_db($feedback_to_website,$con);
if(mysql_query("update feedbackonwebsite set feedback='{$fback}',when1='".date('Y-m-d H:i:s')."' where fromid='{$_SESSION['userid']}'"))
echo "1";
else echo "0";
}
}

}
else
{
header('location:home.php');
}
?>