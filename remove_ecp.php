<?php

include("environment.php");
check_auth();

if(!empty($_POST['pic_id']))
{

if(delete_row("eyecandy_pics_of_user{$_SESSION['userid']}","pic_id",$_POST['pic_id'],$eyecandy_db))
echo '1';
else echo '0';
}
else
{
header('location:home.php');
}

?>