<?php

include("environment.php");
check_auth();

if(!empty($_POST['request']))
$_POST['toid']=$_POST['request'];

if(!empty($_POST['toid']) && !empty($_POST['type']) && in_array($_POST['type'],array("friend","family","col","aqu","no")))
{

if(empty($_POST['points'])){
$_POST['points']=0;
}

if(!if_alreadyexists($_SESSION['userid'],$_POST['toid']) && !if_alreadyexists($_POST['toid'],$_SESSION['userid']) && !if_exists("user{$_POST['toid']}","requestid",$_SESSION['userid']) && !if_exists("user{$_SESSION['userid']}","requestid",$_POST['toid']))
{
if(send_invitetion($_SESSION['userid'],$_POST['toid'],$_POST['type'],$_POST['points'])){

if($_POST['points']>0){
//deducing invitor's points
update_points($_SESSION['userid'],$_POST['points'],"deduce");
}

//echo "1";

echo "success"; 
}

else{
//echo "0";
echo "failed";
}
}

else{
//echo "0";
echo "failed";
}
}

else
{
header('location:home.php');
}
?>