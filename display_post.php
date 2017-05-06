<?php

include("environment.php");
check_auth();

if(!empty($_POST['p_id']))
{

//displaying post 
display_posts(1,1,$_POST['p_id']);

}

else
{
header('location:home.php');
}
?>