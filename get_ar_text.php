<?php

include("environment.php");
check_auth();

if(!empty($_POST['fback']))
{
$ar=entity_value("autoresponses4user{$_SESSION['id']}","response","feedback",$_POST['fback'],$autoresponses_db); 
if(!empty($ar))
echo user_name($_SESSION['id'])." to you: {$ar}";
}
else
{
header('location:home.php');
}
?>