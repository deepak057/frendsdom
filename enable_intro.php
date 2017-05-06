<?php

include("environment.php");
check_log_in($_SERVER["REQUEST_URI"]);

if(is_logged_in()){
update_entity("userdata","id",$_SESSION['userid'],"intro_enabled","1");
header('location:home.php');
}

?>