<?php 

include("environment.php");
check_auth();

if(!empty($_POST['msgid'])) 
{

if(delete_row("msgboxofuser{$_SESSION['userid']}","msgid",$_POST['msgid'],$msg_inbox))
{
echo "success";
}
else
{
echo "failed";
}
}

else
{
header('location:home.php');
}

?>
