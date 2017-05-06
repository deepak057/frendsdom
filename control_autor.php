<?php

include("environment.php");
check_auth();

if(!empty($_POST['state']))
{

if(in_array($_POST['state'],array("on","off")))
{
if(update_entity("userdata","id",$_SESSION['userid'],"auto_response",$_POST['state']))
echo "1";
else echo "failed";
}
else echo "Error: Invalid state supplied";
}
else
{
header('location:home.php');
}
?>