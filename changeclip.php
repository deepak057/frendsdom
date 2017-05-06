<?php

include("environment.php");
check_auth();

if((!empty($_POST['clip'])) || (!empty($_POST['action'])))
{

$dbLink =new mysqli($host,$db_user,$db_passwd,$soundclips_db);
if(mysqli_connect_errno()) 
{
die("MySQL connection failed: ". mysqli_connect_error());
}

switch($_POST['action'])
{
case "change":
if($dbLink->query("update soundclipsofuser{$_SESSION['userid']} set set1='no' where set1='yes'") && $dbLink->query("update soundclipsofuser{$_SESSION['userid']} set set1='yes' where clipid='{$_POST['clip']}'")) 
echo "success"; 
else 
echo "failed";
@mysqli_close($dbLink);
break;

case "del":

//first, delete the file
unlink(get_clip_path($_SESSION['userid'])."/".$_POST['clip']);

//remove from database
if($dbLink->query("delete from soundclipsofuser{$_SESSION['userid']}  where clipid='{$_POST['clip']}'")) 
{

//set first row in table as default audio clip (if it exists)
$dbLink->query("update soundclipsofuser{$_SESSION['userid']}  set set1='yes' LIMIT 1");

echo "success";
}
else echo "failed"; 
break;
}
}

else
{
header('location:home.php');
}
?>