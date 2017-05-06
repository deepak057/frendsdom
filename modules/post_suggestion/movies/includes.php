<?php

//include system's environment 
include('../../../includes/includes.php');

//set_error_handler('errorHandler');
//error_reporting(NONE);
check_auth();

include('../custom.class.php');
include('movies.class.php');

//path to this module
$m_path=$movie_module;

//instantiate class news
$movies=new movies();
?>