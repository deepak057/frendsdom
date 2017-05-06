<?php

//in case of direct access to this script, exit quietly 
if (!defined('BASEPATH') && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
{
exit;
}

//include common files
include("../includes/includes.php");

//check if user authentication is required
if(empty($_REQUEST['auth']) || $_REQUEST['auth']!="false"){
check_auth();
}

//include requested Core file
require("../core/{$_REQUEST['core_action']}/{$_REQUEST['core_file']}");


?>