<?php
session_start();

require 'globals.php';
require 'oauth_helper.php';


// Fill in the next 3 variables.
$guid=$_SESSION['yahoo_xoauth_yahoo_guid'];
$access_token=$_SESSION['yahoo_access_token'];
$access_token_secret=$_SESSION['yahoo_oauth_token_secret'];

// Call Contact API
$user = callcontact(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET,
                      $guid, $access_token, $access_token_secret,
                      false, true);




$user=json_decode($user);


//array to hold contact's information
$contacts_info=array();$i=0;

//extracting required info from received data
$total=$user->query->count;
foreach($user->contacts->contact as $contact){
foreach($contact->fields as $fields){
if($fields->type=="email"){
$contacts_info[$i]['email']=$fields->value;
}
if($fields->type=="name"){$contacts_info[$i]['name']=$fields->value->givenName." ".$fields->value->familyName;
}
}
$i++;
}

//include system's environment
require '../../includes/includes.php';

//including file required for rendering the page
require '../display_page.php';



//displaying page's content
display_page("yahoo",$contacts_info);



exit(0);

/**
 * Call the Yahoo Contact API
 * @param string $consumer_key obtained when you registered your app
 * @param string $consumer_secret obtained when you registered your app
 * @param string $guid obtained from getacctok
 * @param string $access_token obtained from getacctok
 * @param string $access_token_secret obtained from getacctok
 * @param bool $usePost use HTTP POST instead of GET
 * @param bool $passOAuthInHeader pass the OAuth credentials in HTTP header
 * @return response string with token or empty array on error
 */
function callcontact($consumer_key, $consumer_secret, $guid, $access_token, $access_token_secret, $usePost=false, $passOAuthInHeader=true)
{
  $retarr = array();  // return value
  $response = array();

  $url = 'http://social.yahooapis.com/v1/user/' . $guid . '/contacts;count=500';
  $params['format'] = 'json';
  $params['view'] = 'compact';
  $params['oauth_version'] = '1.0';
  $params['oauth_nonce'] = mt_rand();
  $params['oauth_timestamp'] = time();
  $params['oauth_consumer_key'] = $consumer_key;
  $params['oauth_token'] = $access_token;

  // compute hmac-sha1 signature and add it to the params list
  $params['oauth_signature_method'] = 'HMAC-SHA1';
  $params['oauth_signature'] =
      oauth_compute_hmac_sig($usePost? 'POST' : 'GET', $url, $params,
                             $consumer_secret, $access_token_secret);

  // Pass OAuth credentials in a separate header or in the query string
  if ($passOAuthInHeader) {
    $query_parameter_string = oauth_http_build_query($params, true);
    $header = build_oauth_header($params, "yahooapis.com");
    $headers[] = $header;
  } else {
    $query_parameter_string = oauth_http_build_query($params);
  }

  // POST or GET the request
  if ($usePost) {
    $request_url = $url;
    logit("callcontact:INFO:request_url:$request_url");
    logit("callcontact:INFO:post_body:$query_parameter_string");
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $response = do_post($request_url, $query_parameter_string, 80, $headers);
  } else {
    $request_url = $url . ($query_parameter_string ?
                           ('?' . $query_parameter_string) : '' );
    logit("callcontact:INFO:request_url:$request_url");
    $response = do_get($request_url, 80, $headers);
  }

  // extract successful response
  if (! empty($response)) {
    list($info, $header, $body) = $response;
    if ($body) {
      logit("callcontact:INFO:response:");
      //print(json_pretty_print($body));
    }
    $retarr = $response;
  }

  //return $retarr;
return json_pretty_print($body);
}
?>
