<?php

include("environment.php");
check_auth();

if(!empty($_POST['fback']) && !empty($_POST['p_id']))
{

//tweak to correct a spelling mistake
$_POST['fback']=$_POST['fback']=="awesom"?"awesome":$_POST['fback'];

if(in_array($_POST['fback'],array("like","awesome","best","all")))
{


if($_POST['fback']=="all")
$users=return_array_tweaked($fback_to_posts_db,$_POST['p_id'],"fromid");
else
$users=return_array_tweaked($fback_to_posts_db,$_POST['p_id'],"fromid","fback",$_POST['fback']);

//now getting the appropriate title
if($_POST['fback']=="like")
$title="People who {$_POST['fback']}d this post";
else if($_POST['fback']=="awesome" || $_POST['fback']=="best")
$title="People who thought this post was {$_POST['fback']}";
else if($_POST['fback']=="all")
$title="All of those who gave feedback";


//compressing HTML content 
//ob_start("ob_gzhandler"); 

echo "<h4 >{$title}</h4><span  style='position:absolute;top:0px;right:5px;' class='red_onhover' title='Close' onclick='hide_fbackfrom();'></span><table style='font-size:14px;'><tr>";

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
<td><a href="visit.php?id=<?php echo $users[$i]; ?>"><img src="<?php echo prof_pic($users[$i]);?>" height="40" width="40" align="middle"/></a>&nbsp;<a href="<?php echo get_profile_url($users[$i]); ?>" data-hovercard-id="<?php echo $users[$i];?>" class='dui'><?php echo TuneTheName(user_name($users[$i]),12); ?></a></td>
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