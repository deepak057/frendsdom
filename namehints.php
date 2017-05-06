<?php

include("environment.php");
check_auth();

if(!empty($_POST['str']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

$found=0;
$str=htmlentities(trim($_POST['str']));
$userlist=return_array('user'.$_SESSION['userid'],'listid');
for($i=0;$i<sizeof($userlist);$i++)
{
$user_name=user_name($userlist[$i]);
if(strtolower(substr($user_name,0,strlen($str)))==$str && account_status($userlist[$i]))
{
?>
<span onclick='addname("<?php echo $userlist[$i];?>","<?php echo user_name($userlist[$i]);?>")' onmouseover='this.style.background="pink";' onmouseout='this.style.background="none";'><?php echo $user_name;?></span></br>
<?php
$found++;
}
}
if($found==0)
echo "No such name found";
}
else
{
header('location:home.php');
}
?>