<?php
include('../../includes/FunctionList.php');

?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
            <link rel="icon" href="<?php echo SITE_URL; ?>/awesom.bmp" />
            <title>Frendsdom</title>
            <script src="<?php echo SITE_URL; ?>/jquery-1.4.js" type="text/javascript"></script><script src="<?php echo SITE_URL; ?>/script.js" type="text/javascript"></script><script type="text/javascript" src="<?php echo SITE_URL; ?>/jquery.monnaTip.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css8.css" />
            </head>
<body>
 <div id="body">
              <?php get_header_1(); ?>
<center>
<div class="creation_report shaded_grey_back">

<?php
define('FACEBOOK_APP_ID', '396952593717300');
define('FACEBOOK_SECRET', '0a1c71e44f2572639b5537b9e36a6d03');

function parse_signed_request($signed_request, $secret) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    error_log('Unknown algorithm. Expected HMAC-SHA256');
    return null;
  }

  // check sig
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_', '+/'));
}

if ($_REQUEST) {

  $response = parse_signed_request($_REQUEST['signed_request'], 
                                   FACEBOOK_SECRET);
  
/*process received data from Facebook*/

$_POST['first']=$response['registration']['first_name']; 
$_POST['last']=$response['registration']['last_name']; 
$_POST['sex']=$response['registration']['gender']; 
$_POST['email']=$response['registration']['email']; 
$_POST['pass1']=$response['registration']['password']; 
$_POST['pass2']=$response['registration']['password']; 


//get date of birth
$temp=explode("/",$response['registration']['birthday']);
$_POST['dob']=$temp[0]."/".$temp[1]."/".$temp[2];

//get city,state,country
$temp=explode(",",$response['registration']['location']['name']);
$_POST['city']=$temp[0];
$_POST['country']=$temp[1];
$_POST['state']=$response['registration']['state'];
$_POST['signup_via']="facebook";

//file to create account
require(HOME.'/confirm.php');

} else {
  echo '$_REQUEST is empty';
}
?>

</div>
</center>
<?php get_footer_1(true);?>
</div>
</body>
</html>