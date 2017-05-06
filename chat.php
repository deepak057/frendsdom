<?php

include("environment.php");
check_auth();


define('DB_SERVER', $host);
define('DB_USERNAME', $db_user);
define('DB_PASSWORD',$db_passwd);
define('DB_DATABASE',$chat_db);
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());

if ($_GET['action'] == "chatheartbeat") { chatHeartbeat(); } 
if ($_GET['action'] == "sendchat") { sendChat(); } 
if ($_GET['action'] == "closechat") { closeChat(); } 
if ($_GET['action'] == "startchatsession") { startChatSession(); } 
if ($_GET['action'] == "chatname") { chatName(); } 

if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}

function chatHeartbeat() {
	$sql = "select chat.from,chat.message,chat.to,chat.id,chat.sent,chat.recd from chat where (chat.to = '".mysql_real_escape_string($_SESSION['userid'])."' AND recd = 0) order by id ASC";
	

	$query = mysql_query($sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysql_fetch_array($query)) {

$user_name=user_name($chat['from']);

		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
			$items = $_SESSION['chatHistory'][$chat['from']];
		}

		$chat['message'] = sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"u": "{$user_name}",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['from']])) {
		$_SESSION['chatHistory'][$chat['from']] = '';
	}

	$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"u": "{$user_name}",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['from']]);
		$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$sql = "update chat set recd = 1 where chat.to = '".mysql_real_escape_string($_SESSION['userid'])."' and recd = 0";
	$query = mysql_query($sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
/*
$suser=$_SESSION['userid'];
mysql_select_db($GLOBALS['selected_db']);
$sc=mysql_query("select first from userdata where id='$su'");

while($row_sc=mysql_fetch_array($sc))
{
$_SESSION['current_chat_username']=$row_sc['first'];
}*/
?>
{
		"username": "<?php echo $_SESSION['userid'];?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php
	exit(0);
	
}

function chatName() {
	$un = '';
	
$su=$_GET['usw'];
mysql_select_db($GLOBALS['selected_db']);

$sc2=mysql_query("select first from userdata where id='$su' limit 1");
while($row_sc2=mysql_fetch_array($sc2))
{
$un=$row_sc2["first"];
}
?>
{
		"unm": ["<?php echo $un;?>"]
		
}

<?php


	exit(0);
}



function sendChat() {
	$from = $_SESSION['userid'];
	$to = $_POST['to'];
	$message = $_POST['message'];
mysql_select_db($GLOBALS['selected_db']);


	$sql = "select first from userdata where id='$from' limit 1";
	$uname = mysql_query($sql);
	$from_user='';
	while ($un = mysql_fetch_array($uname)) {
	$from_user=$un['first'];
	}
	
	
	$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());
	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}

	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"u": "{$from_user}",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$_POST['to']]);
mysql_select_db($GLOBALS['chat_db']);

	$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".mysql_real_escape_string($from)."', '".mysql_real_escape_string($to)."','".mysql_real_escape_string($message)."',NOW())";
	$query = mysql_query($sql);
	echo "1";
	exit(0);
}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}