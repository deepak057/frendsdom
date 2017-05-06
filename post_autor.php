<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$autoresponses_db);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}

//dropping already existing autoresponses4user table
$mysqli->query("drop table autoresponses4user{$_SESSION['userid']}");

$fback=array("like","dislike","love","hate","stupid","awesom","alterd","likeminded","best");
foreach( $fback as $row ) {$ql[] ='("'.$row.'","'.addslashes(htmlentities(substr($_POST["{$row}_rt"],0,200))).'")';}


if($mysqli->query("create table autoresponses4user{$_SESSION['userid']} (response_index Int Unsigned Not Null Auto_Increment,primary key(response_index),feedback varchar(20) not null,response varchar(200))"))
{
if($mysqli->query("insert into autoresponses4user{$_SESSION['userid']} (feedback,response) values ".implode(",",$ql))===false)
die( "Failed to create your database");else echo "1";
}
else die ("Failed to create your database");
}
else
{
header('location:home.php');
}
?>