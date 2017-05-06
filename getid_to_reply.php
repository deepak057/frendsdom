<?php 

include("environment.php");
check_auth();

if(!empty($_POST['n']))
{

$id=entity_value("msgboxofuser".$_SESSION['userid'],"from1id","msgid",entity_value("tempmsgboxofuser".$_SESSION['userid'],"msgid","id",$_POST['n'],$msg_inbox),$msg_inbox);
echo $id."&".user_name($id); 
}

else
{
header('home.php');
}
?> 
