<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_id']))
{

echo implode(",",return_array_tweaked($picdata_db,$_POST['col_id'],"pic_id"));

}

else
{
header('location:home.php');
}
?>