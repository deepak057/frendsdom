<?php 

include("environment.php");
check_auth();

if(!empty($_POST['msgid']))
{

$list=return_array_tweaked($msg_inbox,"tempmsgboxofuser".$_SESSION['userid'],"msgid");
for($i=0;$i<sizeof($list);$i++)
{
if($list[$i]==$_POST['msgid'])
{
unset($list[$i]);
break;
}
}

array_multisort($list);

//deleting temporary usermsgbox table if already exists

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}

$mysqli->query("drop table tempmsgboxofuser{$_SESSION['userid']}");

//creating temporary user msgbox table if still there are more unread msgs

if(!empty($list))
{

foreach( $list as $row ) {$ql[] ='("'.$row.'")'; }


if($mysqli->query("create table tempmsgboxofuser{$_SESSION['userid']} (id Int Unsigned Not Null Auto_Increment,primary key(id),msgid varchar (50) not null)"))
{
if($mysqli->query("insert into tempmsgboxofuser{$_SESSION['userid']} (msgid) values ".implode(",",$ql))===false)
die("Failed to create your database");
}
else die ("Failed to create your database");
}

//if all goes fine,then confirming it
echo "success";
}

else
{
header('location:home.php');
}
?>