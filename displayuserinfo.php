<?php

include("environment.php");
check_auth();

//preventing direct access to this script
if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
{
header('location:home.php');
exit('');
}

if(!empty($_GET['id']))
$_POST['id']=$_GET['id'];

if(!empty($_POST['id']))
{

include('class_lib.php');

$user=new user($_POST['id']);
$arg='"sbox"';

echo "<table align='left' style='background:#fff;font-size:12px;color:#666;'><tr><td><b>Name : </b>".$user->get_name()." (<img src='".$user->get_sex().".gif' height='20' width='20' align='top'>".$user->get_sex().")</p><p><b>Location :</b> ".$user->get_city().",".$user->get_state()."</p><p><b>Country: </b>".$user->get_country()."</p>";

//checking email visibility
if(is_email_visible($user)){
echo "<p><b>E-mail:</b>".$user->get_email()."</p>";;
}

//enabling "See Sharebox" button if user info is viewed in Hovercard
if(empty($_GET['id']))
echo "<p><span user-id='{$_POST['id']}' class='pointer' onclick='manipulate_hc_content(this,{$arg})'><img  height='15' width='15' align='middle' src='share.png'/>&nbsp;<u>See sharebox</u></span></p>";


echo "</td><td>";

if($user->user_pic())
{
echo '<image style="margin-left:30px;" src="'.$user->prof_pic().'"  height="140" width="180" alt="Please wait while image is loading"></td>';
}
else
{
echo '<img style="margin-left:30px;" src="'.$user->prof_pic().'"  height="140" width="180" alt="no picture uploaded yet by '.$user->get_name().'"></td>';
}
echo "</tr></table>";
}
else
{
header('location:home.php');
}
?>