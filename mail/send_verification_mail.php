<?php


include("environment.php");

include("class_lib.php");

//for ($i=2540;$i<=2556;$i++){

$u=new user($i);

$data=sha1(md5(date('Y-m-d H:i:s')."_".$u->get_password()."_".$u->get_email()));

send_verification_mail($u->get_email(),"id={$i}&data={$data}");


//}


?>