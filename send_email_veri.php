<?php


if(!empty($_POST['email']))
{

include("environment.php");

if(!check_if_exists("userdata","user_id",$_POST['email']) && (entity_value("userdata","email_verified","user_id",$_POST['email'])!=1))
{
if(send_verification_mail($_POST['email'],"id=".entity_value("userdata","id","user_id",$_POST['email'])."&data=".entity_value("userdata","email_verified","user_id",$_POST['email'])))
echo "1";else echo "0";
}
else echo "0";
}
else {
header('location:main.php');
}
?>