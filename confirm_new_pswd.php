<?php

if(!empty($_POST['email']) && !empty($_POST['id']) && !empty($_POST['k']) && !empty($_POST['pass'])) 
{

include("environment.php");

$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$sub="Know some random people from all around the world";

if(entity_value("forgot_pswd_table","encrypted_key","email",$_POST['email'],$other_data_db)==$_POST['k']){

if(update_entity("userdata","user_id",$_POST['email'],"password",sha1(trim($_POST['pass']))))
{

if(delete_row("forgot_pswd_table","email",$_POST['email'],$other_data_db)){

mail($_POST['email'],"Account password changed successfully","Frendsdsom-A social network to expand your world\n\nHi there,\nYou have changed your password successfully.\n\nFor any query, feel free to contact us at : admin@frendsdom.com ",$headers);

echo '1';

}

else echo '0';

}
else echo '0';

}


else {

echo '0';

}

}

else 
{
header('location:home.php');
}

?>