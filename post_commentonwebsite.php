<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['comment']))
{

//filtering the comment received
$_POST['comment']=addslashes(htmlentities(trim($_POST['comment'])));

$mysqli=new mysqli($host,$db_user,$db_passwd,$comment_on_website);
if($mysqli===false)
{
die("Could not connect to database");
}
if($mysqli->query("insert into commentsonwebsite (fromid,comment,when1) values('{$_SESSION['userid']}','{$_POST['comment']}','".date('Y-m-d H:i:s')."')"))
echo "1";
else echo "0";
}
else
{
header('location:home.php');
}
?>