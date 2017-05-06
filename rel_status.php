<?php

include("environment.php");
check_auth();

if(!empty($_POST['action']))
{

if($_POST['action']=="show")
$_POST['action']="yes";
else
$_POST['action']="no";

if(!update_entity("userdata","id",$_SESSION['userid'],"show_rel_status",$_POST['action']))
echo "failed";
}

else
{
header('location:home.php');
}
?>