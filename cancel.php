<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

if(if_exists("user{$_POST['id']}","requestid",$_SESSION['userid']))
{
$points_offered=entity_value("user{$_POST['id']}","points","requestid",$_SESSION['userid']);

if(delete_row("user{$_POST['id']}","requestid",$_SESSION['userid']))
{

//releasing offered points back to invitor's account
if($points_offered){
update_points($_SESSION['userid'],$points_offered);
}

echo "success";
}
else{
echo "failed";
}

}
else{
echo "failed";
}

}

else
{
header('location:home.php');
}
?>