<?php

include("environment.php");
check_auth();

if(!empty($_POST['pv_public']) && in_array($_POST['pv_public'],array("y","n")) && !empty($_POST['pv_rel']) && !empty($_POST['p_id']))
{

//manipulating variables for database
if($_POST['pv_public']=="y")$_POST['pv_public']=1;else $_POST['pv_public']=0;

//updating database
$mysqli =new mysqli($host,$db_user,$db_passwd,$posts_db);
if($mysqli->query("update posts_record_of_user{$_SESSION['userid']} set public={$_POST['pv_public']},relations='{$_POST['pv_rel']}' where post_id='{$_POST['p_id']}'"))
echo "1";
else echo "0";
}
else
{
header('location:home.php');
}
?>