<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_id']))
{

if(in_array($_POST['col_id'],return_array_tweaked($pic_collection_record_db,"piccollection4user{$_SESSION['userid']}","collection_id")) && delete_row("piccollection4user{$_SESSION['userid']}","collection_id",$_POST['col_id'],$pic_collection_record_db))
{
$dbLink =new mysqli($host,$db_user,$db_passwd,$picdata_db);if(mysqli_connect_errno()) {die("MySQL connection failed: ". mysqli_connect_error());}
if($dbLink->query("drop table ".implode(",",return_array_tweaked($picdata_db,$_POST['col_id'],"pic_id"))) || $dbLink->query("drop table {$_POST['col_id']}"))
echo '1';
else echo '0';
}
else echo "Error : no collection found";
}
else 
{
header('location:home.php');
}
?>