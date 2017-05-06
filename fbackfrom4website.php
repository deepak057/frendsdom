<?php

include("environment.php");
check_auth();

if(!empty($_POST['fback']) && !empty($_POST['id']))
{

if(in_array($_POST['fback'],array("like","dislike","love","hate","awesom","stupid","best","all")))
{

if($_POST['fback']=="all")
$users=return_array_tweaked($feedback_to_website,"feedbackonwebsite","fromid");
else
$users=return_array_tweaked($feedback_to_website,"feedbackonwebsite","fromid","feedback",$_POST['fback']);

//now getting the appropriate title
if($_POST['fback']=="like" || $_POST['fback']=="hate" || $_POST['fback']=="love" || $_POST['fback']=="dislike")
$title="People who {$_POST['fback']}d this website";
else if($_POST['fback']=="awesom" || $_POST['fback']=="stupid")
$title="People who thought the idea of this </br>website was ".($_POST['fback']=="awesom"?"awesome":$_POST['fback']);
else if($_POST['fback']=="best")
$title="People who thought this was the best website";
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
<td ><img src="<?php echo prof_pic($users[$i]);?>" height="40" width="40" align="middle">&nbsp;<a href="<?php echo get_profile_url($users[$i]); ?>" id="<?php echo $users[$i];?>" class='fback_from1'><?php echo tunethename(user_name($users[$i]),12); ?></a></td>
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