<?php

include('environment.php');
check_auth();

if(!empty($_GET['view']))
{
set_user_value("home_main_view",$_GET['view']);

//check if Page view is MAKE POINTS, hide slide panel
if($_GET['view']==MP_VIEW){
set_user_value("slide_panel",0);
}

}

//redirect to home
header("location:home.php");

?>