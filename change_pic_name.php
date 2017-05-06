<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_id']) && !empty($_POST['pic_id']) && !empty($_POST['new_name']))
{

if(in_array($_POST['col_id'],return_array_tweaked($pic_collection_record_db,"piccollection4user{$_SESSION['userid']}","collection_id")) && in_array($_POST['pic_id'],return_array_tweaked($picdata_db,$_POST['col_id'],"pic_id")))
{
if(update_entity($_POST['col_id'],"pic_id",$_POST['pic_id'],"pic_name",addslashes(htmlentities(trim(substr($_POST['new_name'],0,39)))),$picdata_db))
echo '1';
else echo "failed";
}
 
else {

echo "Error : invalid operation";

}
 
}

else 
{
header('location:home.php');
}
?>