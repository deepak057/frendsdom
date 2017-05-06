<?php

include("environment.php");
check_auth();

if(!empty($_POST['id'])) 
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}
if($mysqli->query("delete from user{$_SESSION['userid']}  where listid='{$_POST['id']}'") && $mysqli->query("delete from user{$_POST['id']}  where listid='{$_SESSION['userid']}'"))
{
remove_posts_record($_SESSION['userid'],$_POST['id']);
if(if_exists("authorityrecpients4user".$_SESSION['userid'],'recpient_id',$_POST['id'],$authority_recpients_db) && if_exists("authorityrecpients4user".$_POST['id'],'recpient_id',$_SESSION['userid'],$authority_recpients_db))
{
$mysqli=new mysqli($host,$db_user,$db_passwd,$authority_recpients_db);
if($mysqli->query("delete from authorityrecpients4user{$_SESSION['userid']}  where recpient_id='{$_POST['id']}'") && $mysqli->query("delete from authorityrecpients4user{$_POST['id']}  where recpient_id='{$_SESSION['userid']}'"))
echo "1";else echo "failed";
}
else echo "1";
}
else echo "failed";
}
else 
{
header('location:home.php');
}
?>