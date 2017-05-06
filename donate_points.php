<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['p']))
{

//deducing donated points donator's account
if(update_points($_SESSION["userid"],$_POST['p'],"deduce")){

//adding donated points to receiver's account
if(update_points($_POST['id'],$_POST['p'])){

//inserting new news into news4user table
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
$mysqli->query("insert into news4user{$_POST['id']} (news,from_id,when1 ) values ('donated_points*{$_POST['p']}','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')");

//confirming success
echo "1";

}
else{
echo "0";
}
}
else{
echo "0";
}
}
else{
header('location:home.php');
}
?>