<?php

include("environment.php");
check_auth();

if(!empty($_POST['fback']) && !empty($_POST['id']))
{

if(in_array($_POST['fback'],array("like","dislike","love","hate","awesom","likeminded","stupid","alterd","best","all")))
{

if($_POST['fback']=="all")
$users=return_array_tweaked($feedback_to_profile_db,"profilefeedback4user".$_POST['id'],"fromid");
else
$users=return_array_tweaked($feedback_to_profile_db,"profilefeedback4user".$_POST['id'],"fromid","feedback1",$_POST['fback']);

//now getting the appropriate title
if($_POST['fback']=="like" || $_POST['fback']=="hate" || $_POST['fback']=="love" || $_POST['fback']=="dislike")
$title="People who {$_POST['fback']}d this profile";
else if($_POST['fback']=="awesom" || $_POST['fback']=="stupid")
$title="People who thought color combination </br>was ".($_POST['fback']=="awesom"?"awesome":$_POST['fback']);
else if($_POST['fback']=="likeminded")
$title="People who thought they were like minded";
else if($_POST['fback']=="alterd")
$title="People who thought color combination </br> should be altered ";
else if($_POST['fback']=="best")
$title="People who thought this was the best ";
else if($_POST['fback']=="all")
$title="All of those who gave feedback";


//compressing HTML content 
ob_start("ob_gzhandler"); 

echo "<h4 >{$title}</h4><span  style='position:absolute;top:0px;right:5px;' class='red_onhover' title='Close' onclick='hide_fbackfrom();'>&#215;</span><table><tr>";

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

else {
die("Error: invalid feedback entry received");
}
}

else
{
header('location:home.php');
}
?>