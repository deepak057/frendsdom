<?php 

include("environment.php");
check_auth();

if((!empty($_POST['toid'])) && (!empty($_POST['msg'])) && (!empty($_POST['title'])))
{

if(send_msg($_SESSION['userid'],$_POST['toid'],$_POST['title'],$_POST['msg']))
echo "success";
else echo "failed";
}

else
{
header('location:home.php');
}
?>