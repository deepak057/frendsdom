<?php

include("environment.php");
check_auth();

if(!empty($_POST['share_id']))
{

if(delete_row("sboxofuser{$_SESSION['userid']}","share_id",$_POST['share_id'],$share_box_db))
echo '1';
else echo '0';

}

else {

header('location:home.php');

}


?>