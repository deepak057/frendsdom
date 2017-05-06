<?php

include("environment.php");
check_auth();

if(!empty($_GET['q']))
{

$suggestion_list=array();$j=0;
$str=htmlentities(trim($_GET['q']));
$userlist=return_array('user'.$_SESSION['userid'],'listid');
for($i=0;$i<sizeof($userlist);$i++)
{
$user_name=user_name($userlist[$i]);
if(strtolower(substr($user_name,0,strlen($str)))==$str && account_status($userlist[$i]))
{
$suggestion_list[$j]['name']='<div class="inline">'.$user_name.'</div>';
$suggestion_list[$j]['id']=$userlist[$i];
$j++;
}
}
echo json_encode($suggestion_list);
}
else
{
header("location:home.php");
}
?>