<?php

session_start();

//refering to main page if no ussername session found

if((empty($_SESSION["userid"])) || (empty($_SESSION["userkey"])) || (empty($_SESSION["home"])))
{
header('location:main.php');
}


?>