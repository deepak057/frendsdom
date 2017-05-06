<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

if(user_sex($_POST['id'])=="female")$hh="her";else $hh="his";

//compressing HTML content 
//ob_start("ob_gzhandler"); 

echo "<h4 >People who commented on {$hh} profile</h4><span  style='position:absolute;top:0px;right:5px;' class='red_onhover' title='Close' onclick='hide_fbackfrom();'>&#215;</span><table><tr>";

$users=array_unique(return_array_tweaked($comment_on_profile_db,"profilecomments4user{$_POST['id']}","fromid"));
array_multisort($users);

if(!empty($users))
{

for($i=0;$i<sizeof($users);$i++)
{
if(account_status($users[$i]))
{
if($i%4==0)
{
echo "</tr><tr>";
}
?>
<td ><img src="<?php echo prof_pic($users[$i]);?>" height="40" width="40" align="middle">&nbsp;<a href="visit.php?id=<?php echo $users[$i]; ?>" id="<?php echo $users[$i];?>" class='fback_from1'><?php echo user_name($users[$i]); ?></a></td>
<?php
}
}
echo "</tr></table>";
}

else echo "<font color='blue'>Nobody</font>";

}

else
{
header('location:home.php');
}
?>