<?php

include("environment.php");
error_reporting(E_ERROR); 
    
if(isset($_SESSION['userid']))
{
logout($_SESSION['userid']);
}

header('location:main.php');
?>