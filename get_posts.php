<?php

include("environment.php");
check_auth();

if(!empty($_POST['end']))
{

if(empty($_POST['start']))
$_POST['start']=0; 

//checking if order has to be ASC or DSC
$order_filter=empty($_POST['order_filter']) ? false : true;

//checking if "uid" is upplied
$uid=empty($_POST['uid'])?false:$_POST['uid'];

//check "vuid" is passed (id of user whose profile is being visited)
$from_id=empty($_POST['from_id'])?false:$_POST['from_id'];

//displaying posts
display_posts($_POST['start'],$_POST['end'],false,$order_filter,$uid,$from_id);

}
else
{
header('location:home.php');
}
?>