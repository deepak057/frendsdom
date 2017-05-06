<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['comment']))
{

//filtering the comment received
$_POST['comment']=addslashes(htmlentities(trim($_POST['comment'])));

$d=date('Y-m-d H:i:s');

$mysqli=new mysqli($host,$db_user,$db_passwd,$comment_on_profile_db);
if($mysqli===false)
{
die("Could not connect to database");
}
if($mysqli->query("insert into profilecomments4user{$_POST['id']} (fromid,comment,when1) values('{$_SESSION['userid']}','{$_POST['comment']}','{$d}')"))
{
if($_SESSION['userid']!=$_POST['id'])
{

//incrementing user's points by one
update_points($_POST['id'],1);

$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
if($mysqli->query("insert into news4user{$_POST['id']} (news,from_id,when1 ) values ('commentOnProfile_".entity_value("profilecomments4user{$_POST['id']}","comment_no","when1",$d,$comment_on_profile_db)."','{$_SESSION['userid']}','{$d}')"))
{
//handling e-mail news
email_news($_POST['id'],"commentOnProfile");

echo entity_value("profilecomments4user{$_POST['id']}","comment_no","when1",$d,$comment_on_profile_db);

}
else echo "failed";
}
else echo entity_value("profilecomments4user{$_POST['id']}","comment_no","when1",$d,$comment_on_profile_db);

}
else echo "failed";
}
else
{
header('location:home.php');
}
?>