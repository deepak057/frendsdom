<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_id']) && !empty($_POST['pic_id']))
{

if(in_array($_POST['col_id'],return_array_tweaked($pic_collection_record_db,"piccollection4user{$_SESSION['userid']}","collection_id")) && in_array($_POST['pic_id'],return_array_tweaked($picdata_db,$_POST['col_id'],"pic_id")))
{
$dbLink=new mysqli($host,$db_user,$db_passwd,$picdata_db);

if(mysqli_connect_errno()) {die("MySQL connection failed: ". mysqli_connect_error());}

if($dbLink->query("delete from {$_POST['col_id']} where pic_id='{$_POST['pic_id']}'") && $dbLink->query("drop table {$_POST['pic_id']}"))
echo '1';
else echo 'failed';

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