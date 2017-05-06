<?php



//include system's environment
 
include('../../includes/FunctionList.php');

//set_error_handler('errorHandler');

check_auth();


include(HOME."/class_lib.php");

//include get_users class
include("get_users.php");

//create "get_users" object
$get_users=new get_users();

//path of this module
$this_mod=SITE_URL."/modules/post_promotion";



;

?>