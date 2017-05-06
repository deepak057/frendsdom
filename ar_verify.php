<?php

include('environment.php');

if(!empty($_POST['email']) && !empty($_POST['pass']))
{
if(entity_value("userdata","password","user_id",$_POST['email'])==sha1($_POST['pass']))
{

if(!empty($_POST['keep_LI']))
$keep_LI=true;
else $keep_LI=false;

if(update_entity("userdata","user_id",$_POST['email'],"account_status","open") && is_login_valid($_POST['email'],sha1($_POST['pass']),$keep_LI))
echo '1';
else
echo '0';
}
else
echo '0';
}
else
{
header('location:home.php');
}
?>