<?php
include_once 'GmailOath.php';

$cuncumer_key='726640428799.apps.googleusercontent.com';
$cunsumer_secret='tMyQUQuKDqPwdKVujtwYguv2';

$argarray = $argv[0];
$debug = 0; // Set to 1 for verbose debugging output
$callback='http://frendsdom.com/oauth/gmail/GetContact.php';

$oauth =new GmailOath($cuncumer_key, $cunsumer_secret, $argarray, $debug, $callback);

//echo $oauth->oauth_cunsumer_secret;

$getcontact=new GmailGetContacts();
$accrss_token=$getcontact->get_request_token($oauth, false, true, true);
//var_dump($accrss_token);


//get access to Gmail

session_start();

$_SESSION['oauth_token']=$accrss_token['oauth_token'];
$_SESSION['oauth_token_secret']=$accrss_token['oauth_token_secret'];


//redirecting to google
header("location:https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=".$oauth->rfc3986_decode($accrss_token['oauth_token']));


?>


