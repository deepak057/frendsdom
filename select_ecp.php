<?php

include("environment.php");
check_auth();

if(!empty($_POST['pic_id'])) 
{

$mysqli =new mysqli($host,$db_user,$db_passwd,$eyecandy_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($mysqli->query("update eyecandy_pics_of_user{$_SESSION['userid']} set is_set=0 where pic_id!='{$_POST['pic_id']}'") && $mysqli->query("update eyecandy_pics_of_user{$_SESSION['userid']} set is_set=1 where pic_id='{$_POST['pic_id']}'"))
{
echo '1';
}
else
{
echo '0'; 
}
}
else 
{
header('location:home.php');
}
?>