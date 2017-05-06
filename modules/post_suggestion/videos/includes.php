<?php

//include system's environment 
include('../../../includes/includes.php');
//set_error_handler('errorHandler');
check_auth();

include('../custom.class.php');
include('youtube.class.php');

//path to this module
$m_path="modules/post_suggestion/videos";

//instantiate class Youtube
$youtube=new youtube();
?>