<?php

include("environment.php");
check_auth();

if(!empty($_POST['email_pref']) && !empty($_POST['popup_pref']) && !empty($_POST['email_visibility']) && !empty($_POST['msg_pref']))
{

//checking email preference 
if($_POST['email_pref']=="enable")
$_POST['email_pref']='1';
else $_POST['email_pref']=0;


//checking pop up preference
if($_POST['popup_pref']=="enable")
$_POST['popup_pref']='1';
else $_POST['popup_pref']=0;


//checking email_visibility preference
$_POST['email_visibility']=trim($_POST['email_visibility']);
if(!in_array($_POST['email_visibility'],array("relations","private","public")))
$_POST['email_visibility']="private";


//checking message preference
if($_POST['msg_pref']=="enable")
$_POST['msg_pref']='1';
else $_POST['msg_pref']=0;


//updating database
$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}

if($mysqli->query("update userdata set pop_up={$_POST['popup_pref']},e_mail_notification={$_POST['email_pref']},email_visibility='{$_POST['email_visibility']}',message_notification={$_POST['msg_pref']}  where id={$_SESSION['userid']}"))
echo "1";
else echo "0";
}

else {

header('location:home.php');

}

?>