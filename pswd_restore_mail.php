<?php

//including required files

include("environment.php");
include('class_lib.php');

if(!empty($_POST['email'])) 
{
if(!validemail($_POST['email']))
{

$key=null;$r=false;$u=new user(entity_value("userdata","id","user_id",$_POST['email']));

if(!if_exists("forgot_pswd_table","email",$_POST['email'],$other_data_db)){
$key=sha1(md5(date('Y-m-d H:i:s')."_".$u->get_password()."_{$_POST['email']}"));
$mysqli=new mysqli($host,$db_user,$db_passwd,$other_data_db);if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}
if($mysqli->query("insert into forgot_pswd_table(id,email,when1,encrypted_key) values(".$u->get_id().",'{$_POST['email']}','".date('Y-m-d H:i:s')."','{$key}')"))
{
$r=true;
}
}
else {
$key=entity_value("forgot_pswd_table","encrypted_key","email",$_POST['email'],$other_data_db);
$r=true;
}

if($r){

$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .'Reply-To: admin@frendsdom.com' . "\r\n";


if(mail($_POST['email'],"Set new password","Hello ".$u->get_name().",\n\nYou specified your email (".$_POST['email'].") in order to set new password for your Frendsdom account.\n\nPlease click on following link to be able to set a new password\n\nHere's your link: ".SITE_URL."/set_new_pswd.php?id=".$u->get_id()."&email={$_POST['email']}&k={$key} \n\nPlease Note: If you think you didn't request to set a new password and this action was done by someone else , you need not to panic. You would still have full control on your account and your password would remain intact as long as you don't follow above sent link and set a new password yourself.\n\n\n\nContact us: admin@frendsdom.com",$headers))
echo '1';
else echo '0';
}
else {
echo '0';
}
}
else {
echo '0';
}
}
else {
header('location:main.php');
}

?>