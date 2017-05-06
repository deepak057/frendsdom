<?php

//include system's environment
include("../includes/includes.php");

  $config = array(
    'appId' => '396952593717300',
    'secret' => '0a1c71e44f2572639b5537b9e36a6d03',
  );
  
  
  $app_id = $config['appId'];
  $app_secret = $config['secret'];
  $my_url = SITE_URL."/facebook_invite/invite_fb.php";

	$code = $_REQUEST["code"];
	
 // auth user
 if(empty($_REQUEST["code"])) {
    $dialog_url = 'https://www.facebook.com/dialog/oauth?client_id=' 
    . $app_id . '&redirect_uri=' . urlencode($my_url) ;
    echo("<script>top.location.href='" . $dialog_url . "'</script>");
 }
  
  
  $message = "Join me here on Frendsdom, a social network to expand your world";
	
	$thanks = SITE_URL."/facebook_invite/thanks.php";
  $requests_url = "https://www.facebook.com/dialog/apprequests?app_id=" 
  . $app_id . "&redirect_uri=" . urlencode($thanks)
  . "&message=" . $message;

         if (empty($_REQUEST["request_ids"])) {
            echo("<script> top.location.href='" . $requests_url . "'</script>");
         } else {
            echo "Request Ids: ";
            print_r($_REQUEST["request_ids"]);
         }
?>