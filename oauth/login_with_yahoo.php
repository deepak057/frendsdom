<?php
/*
 * login_with_yahoo.php
 *
 * @(#) $Id: login_with_yahoo.php,v 1.1 2012/10/05 09:23:25 mlemos Exp $
 *
 */
	require('display_page.php');
	require('http.php');
	require('oauth_client.php');
	
	$client = new oauth_client_class;
	$client->debug = 1;
	$client->debug_http = 1;
	$client->server = 'Yahoo';
	$client->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].
		dirname(strtok($_SERVER['REQUEST_URI'],'?')).'/login_with_yahoo.php';

	$client->client_id = 'dj0yJmk9cll5WnBlTU85QWtCJmQ9WVdrOVRYVm1SRGQwTXpZbWNHbzlNVGMwTnpNNE9EUTJNZy0tJnM9Y29uc3VtZXJzZWNyZXQmeD0yOA--'; $application_line = __LINE__;
	$client->client_secret = 'a4f801c30283dde025e0c268bd70aaf89bac730c';

	if(strlen($client->client_id) == 0
	|| strlen($client->client_secret) == 0)
		die('Please go to Yahoo Apps page https://developer.apps.yahoo.com/wsregapp/ , '.
			'create an application, and in the line '.$application_line.
			' set the client_id to Consumer key and client_secret with Consumer secret. '.
			'The Callback URL must be '.$client->redirect_uri).' Make sure you enable the '.
			'necessary permissions to execute the API calls your application needs.';


//getting logged-in user's name and email
if(($success = $client->Initialize()))
	{
		if(($success = $client->Process()))
		{
			if(strlen($client->access_token))
			{
				$success = $client->CallAPI(
					'http://query.yahooapis.com/v1/yql', 
					'GET', array(
						'q'=>'select * from social.profile where guid=me',
						'format'=>'json',
						
					), array('FailOnAccessError'=>true), $lu);
			}
		}
		$success = $client->Finalize($success);
	}


//array to hold logged-in user's profile info
$lu_info['name']=ucwords($lu->query->results->profile->givenName." ".$lu->query->results->profile->familyName);
$lu_info['image_url']=$lu->query->results->profile->image->imageUrl;
$lu_info['profile_url']=$lu->query->results->profile->profileUrl;

?>

<div align="left" style="border-bottom:1px solid #000;padding-bottom:5px;margin-bottom:10px;background:yellow;position:relative;top:-6px;">
<a href="<?php echo $lu_info['profile_url']; ?>" title="Your yahoo profile"><img src="<?php echo $lu_info['image_url']; ?>" width="50" height="50"/ align="middle">&nbsp;<?php echo $lu_info['name']; ?></a>
</div>

<?php


//retreiving logged-in emails of logged in user's contacts

	if(($success = $client->Initialize()))
	{
		if(($success = $client->Process()))
		{
			if(strlen($client->access_token))
			{
				$success = $client->CallAPI(
					'http://query.yahooapis.com/v1/yql', 
					'GET', array(
						'q'=>'select * from social.contacts where guid=me',
						'format'=>'json'
					), array('FailOnAccessError'=>true), $user);
			}
		}
		$success = $client->Finalize($success);
	}
	if($client->exit)
		exit;
	if($success)
	{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Invite your Yahoo contacts-Frendsdom</title>
</head>
<body>
<?php

//array to hold contact's information
$contacts_info=array();$i=0;

//extracting required info from received data
$total=$user->query->count;
foreach($user->query->results->contact as $contact){
foreach($contact->fields as $fields){
if($fields->type=="email"){
$contacts_info[$i]['email']=$fields->value;
}
if($fields->type=="name"){$contacts_info[$i]['name']=$fields->value->givenName." ".$fields->value->familyName;
}
}
$i++;
}

//displaying page's content
display_page("yahoo",$contacts_info,$lu_info);

?>
 


</body>
</html>
<?php
	}
	else
	{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>OAuth client error</title>
</head>
<body>
<h1>OAuth client error</h1>
<p>Error: <?php echo HtmlSpecialChars($client->error); ?></p>
</body>
</html>
<?php
	}

?>