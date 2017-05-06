<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['action']) && if_exists("userdata","id",$_POST['id']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['id']) && !(if_exists("authorityrecpients4user".$_SESSION['userid'],'recpient_id',$_POST['id'],$authority_recpients_db)) && !(if_exists("authorityrecpients4user".$_SESSION['userid'],'request_from',$_POST['id'],$authority_recpients_db)))
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$authority_recpients_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}

if($_POST['action']=="request")
$sql="insert into authorityrecpients4user{$_POST['id']} (request_from,requested) values ({$_SESSION['userid']},'".date('Y-m-d H:i:s')."')";
else
$sql="delete from authorityrecpients4user{$_POST['id']} where request_from='{$_SESSION['userid']}'";

if($mysqli->query($sql)===false)
{
echo "Failed";
}
else echo "1";

}
else 
{
header('location:home.php');
}
?>