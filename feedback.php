<?php

include("environment.php");
check_auth();

if(!empty($_POST['fback']))
{

//array containg all expacted feedback values
$feedbacks=array("like","dislike","love","hate","awesom","likeminded","stupid","alterd","best");

//filtering the received data
$fback=htmlentities(trim($_POST['fback']));

//if the feedback retrieved  either is not in above defined array or has value 'no' then deleting the feedback data corresponding to associated id
if(!in_array($fback,$feedbacks) || $fback=="no")
{
if(!$con)die("Failed to connect to database");
$db=mysql_select_db($feedback_to_profile_db,$con);
if(mysql_query("delete from profilefeedback4user{$_SESSION['id']} where fromid='{$_SESSION['userid']}'"))
echo "1";
else echo "0";
}

else
{

$r=false;

if(!check_if_exists("profilefeedback4user".$_SESSION['id'],"fromid",$_SESSION['userid'],$feedback_to_profile_db))
{
$mysqli=new mysqli($host,$db_user,$db_passwd,$feedback_to_profile_db);
if($mysqli===false)
{
die("Could not connect to database");
}
if($mysqli->query("insert into profilefeedback4user{$_SESSION['id']} (fromid,feedback1,when1) values ('{$_SESSION['userid']}','{$fback}','".date('Y-m-d H:i:s')."')"))
{
$r=true;
}
else echo "0";
}

else
{
if(!$con)
die("Failed to connect to database");
$db=mysql_select_db($feedback_to_profile_db,$con);
if(mysql_query("update profilefeedback4user{$_SESSION['id']} set feedback1='{$fback}',when1='".date('Y-m-d H:i:s')."' where fromid='{$_SESSION['userid']}'"))
{
$r=true;
}
else echo "0";
}

if($r)
{
if($_SESSION['id']!=$_SESSION['userid'])
{
//inserting new news into news4user table
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}
if($mysqli->query("insert into news4user{$_SESSION['id']} (news,from_id,when1 ) values ('fback2profile','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')")===false)
echo "failed";else {

//handling notification e-mail
email_news($_SESSION['id'],"fback2profile");

echo "1";}
}
else echo "1";
}

}
}
else
{
header('location:home.php');
}
?>