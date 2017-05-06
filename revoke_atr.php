<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) )
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$authority_recpients_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($mysqli->query("delete from authorityrecpients4user{$_SESSION['userid']} where recpient_id='{$_POST['id']}'") && $mysqli->query("delete from authorityrecpients4user{$_POST['id']} where recpient_id='{$_SESSION['userid']}'"))
{
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
if($mysqli->query("insert into news4user{$_POST['id']} (news,from_id,when1 ) values ('atr_revoked','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')")){

//handling notification e-mail
email_news($_POST['id'],"atr_revoked");

echo "1";
}
else echo "failed";
}
else echo "failed";
}
else 
{
header('location:home.php');
}
?>