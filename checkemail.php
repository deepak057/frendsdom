<?php 

if(!empty($_POST['email']))
{

include("environment.php");
echo json_encode(check_email($_POST['email']));	
}

else{
header('location:home.php');
}

?>