<?php

//include system's environment 
include('../../../includes/includes.php');
//set_error_handler('errorHandler');
check_auth();

include('../custom.class.php');
include('news.class.php');

//instantiate class news
$news=new news();
?>