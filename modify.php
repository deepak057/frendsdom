<?php

include("environment.php");
check_auth();

if((!empty($_POST['entity'])) && (!empty($_POST['value'])) )
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if($mysqli->query("update userdata set {$_POST['entity']}='{$_POST['value']}' where id='{$_SESSION['userid']}'"))
{
echo "1";
}
else echo "failed";
}
else
{
header('location:home.php');
}
?>