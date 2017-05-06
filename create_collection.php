<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_name']))
{

$_POST['col_name']=addslashes(htmlentities(trim($_POST['col_name'])));

if(!in_array($_POST['col_name'],return_array_tweaked($pic_collection_record_db,"piccollection4user{$_SESSION['userid']}","collection_name")))
{
$col_id="collection{$_SESSION['userid']}_".mktime();
$mysqli=new mysqli($host,$db_user,$db_passwd,$pic_collection_record_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($mysqli->query("insert into piccollection4user{$_SESSION['userid']} (collection_name,collection_id,created) values ('{$_POST['col_name']}','{$col_id}','".date('Y-m-d H:i:s')."')"))
{
$mysqli=new mysqli($host,$db_user,$db_passwd,$picdata_db);
if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}
if($mysqli->query("create table {$col_id} (pic_index Int Unsigned Not Null Auto_Increment,primary key(pic_index),pic_name varchar(200) not null default 'New picture',pic_id varchar(200) not null,pic_type varchar(10) not null default 'jpg',pic_size varchar(50),uploaded datetime,pic_data MediumBlob)"))
echo $col_id; else echo 'failed';
}
else echo "failed"; 
}
 
else {
echo "failed: collection with same name already exists";
}
}
else 
{
header('location:home.php');
}

?>