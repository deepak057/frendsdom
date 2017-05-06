<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

$list=return_array("tempuser".$_SESSION['userid'],"request_id");
for($i=0;$i<sizeof($list);$i++)
{
if($list[$i]==$_POST['id'])
{
unset($list[$i]);
break;
}
}

array_multisort($list);

//deleting temporary userrequest table if already exists

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="drop table tempuser{$_SESSION['userid']}";
if($mysqli->query($sql)===true)
{
}

//creating temporary user request table if still there are more requests 

if(!empty($list))
{
foreach( $list as $row ) {$ql[] ='("'.$row.'")'; }

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);

if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
$sql="create table tempuser{$_SESSION['userid']} (id Int Unsigned Not Null Auto_Increment,primary key(id),request_id varchar (50) not null)";

if($mysqli->query($sql)===true)
{
$sql="insert into tempuser{$_SESSION['userid']} (request_id) values ".implode(',',$ql); 
if($mysqli->query($sql)===false)
die( "Failed to create your database");
}
else die ("Failed to create your database");
}

//if all goes fine, then confirming it
echo "success";
}

else
{
header('location:home.php');
}
?>