<?php

include('environment.php');
check_auth();

if(!empty($_GET['view']))
{
set_user_value("home_main_view",$_GET['view']);
}

//redirect to home
header("location:home.php");

?>