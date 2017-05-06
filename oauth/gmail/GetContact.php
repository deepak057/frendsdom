<?php
include_once 'GmailOath.php';

	

$cuncumer_key='726640428799.apps.googleusercontent.com';
$cunsumer_secret='tMyQUQuKDqPwdKVujtwYguv2';
$argarray = $argv[0];
$debug = 0; // Set to 1 for verbose debugging output
$callback='http://frendsdom.com/oauth/gmail/GetContact.php';

$oauth =new GmailOath($cuncumer_key, $cunsumer_secret, $argarray, $debug, $callback);
$getcontact_access=new GmailGetContacts();

session_start();
/////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get the access token using HTTP GET and HMAC-SHA1 signature
$request_token=$oauth->rfc3986_decode($_GET['oauth_token']);
$request_token_secret=$oauth->rfc3986_decode($_SESSION['oauth_token_secret']);
//$oauth_verifier= 'pkzkns';
$oauth_verifier= $oauth->rfc3986_decode($_GET['oauth_verifier']);
$retarr = $getcontact_access->get_access_token($oauth,
                           $request_token, $request_token_secret,
                           $oauth_verifier, false, true, true);

////////////////////////////////////////////////////////////////////
// Call Contact API

$access_token=$oauth->rfc3986_decode($retarr['oauth_token']);
$access_token_secret=$oauth->rfc3986_decode($retarr['oauth_token_secret']);
$contac_list= $getcontact_access->callcontact($oauth, $access_token, $access_token_secret, false, true);

//array to hold the names and emails of contacts
$contacts_info=array();$i=0;
foreach($contac_list as $r){
$contacts_info[$i]['email']=$r['gd$email'][0]['address'];
if(!empty($r['title']['$t']))
$contacts_info[$i]['name']=$r['title']['$t'];
else
$contacts_info[$i]['name']=$contacts_info[$i]['email'];
$i++;
}

//include system's environment
require '../../includes/includes.php';

//including file required for rendering the page
require '../display_page.php';

//displaying page's content
display_page("gmail",$contacts_info);


?>
