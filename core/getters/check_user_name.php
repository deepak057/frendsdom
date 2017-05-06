<?php

$un_success=false;
$un_error=true;
$un_message=false;


//function to ECHO response in JSON format

function un_put_response(){
echo json_encode(array("error"=>$GLOBALS['un_error'],"success"=>$GLOBALS['un_success'],"message"=>$GLOBALS['un_message']));
}

//first, check if supplied USERNAME is valid

if(!validate_username($_POST['username'])){
$un_message="<img src='".get_image("crossmark.gif")."'/> <span class='status-inner-text error_red'>Invalid user name</span>";
un_put_response();exit;
}

//check if supplied USERNAME is available

if(!is_user_name_available($_POST['username'])){
$un_message="<img src='".get_image("crossmark.gif")."'/> <span class='status-inner-text error_red'>Not available</span>";
un_put_response();exit;
}

//If it comes upto here, USERNAME is available

$un_message="<img src='".get_image("checkmark.gif")."'/> <span class='status-inner-text success_green '>Available</span>";
$un_success=true;
$un_error=false;
un_put_response();


?>