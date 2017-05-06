<?php

include("environment.php");
include("class_lib.php");

check_log_in($_SERVER["REQUEST_URI"]);

//compressing HTML content 
//ob_start("ob_gzhandler"); 

//create instance of logged in user
$lu=new user(uid());

?>
<html>
<head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><META HTTP-EQUIV="Content-Language" Content="en">
<link rel="icon" href="<?php echo get_image("favicon.ico"); ?>"><title>Your Msgbox-Frendsdom</title>
<script src="jquery-1.4.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>
<script src="ajax_tooltip/ajax_tooltip.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery.monnaTip.js"></script><script src="msgbox_script.js" type="text/javascript"></script><script type="text/javascript" src="resources/jquery/jquery-ui-1.9.2.custom.min.js"></script><script src="js/jquery.outside.events.js"></script><script src="jquery.hovercard.js" type="text/javascript"></script><script src="apprise/apprise.min.js" type="text/javascript"></script>
<script type="text/javascript" src="resources/jquery/js.js"></script><script type="text/javascript" src="resources/plugin/jquery.ui.combogrid-1.6.2.js"></script><script type="text/javascript" src="jquery.flexibleArea.js"></script><script type="text/javascript" src="chat/chat.js"></script><script src="easing.js"></script>
<script src="nicescroll.js"></script><script type="text/javascript" src="noty/js/jquery.noty.js"></script><script type="text/javascript" src="noty/js/layouts/bottomLeft.js"></script><script type="text/javascript" src="noty/js/themes/default.js"></script>
<link rel="stylesheet" type="text/css" href="css8.css"/>
<link rel="stylesheet" type="text/css" href="msgbox_stylesheet.css"/><link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery.ui.combogrid.css"/><link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.8.9.custom.css"/>
<link rel="stylesheet" type="text/css" href="chat/chat.css"/><link rel="stylesheet" type="text/css" href="ajax_tooltip/style.css"/><link type="text/css" rel="stylesheet" media="all" href="apprise/apprise.min.css" />
<script>user_online();
$(function(){$('*[title]').monnaTip();});$(".flexible_textarea").live("focus",function(){$(this).flexible();});
$(document).ready(function(){
$('.nice_scroll').niceScroll({cursorcolor:"grey"});
preload(["picon1.gif","down.png"]);});
$(document).ready(function(){
	$('#switcher').themeswitcher({
		loadTheme:"Smoothness"
	});
		$( "#search_field" ).combogrid({
		url: 'search_autocomplete.php',
		debug:true,
		sidx: "id",
		sord: "asc",
		rows: 10,
                addClass:"combogrid_class",
                alternate:true,
                draggable: true,
                rememberDrag: true,
                //replaceNull: true,
		colModel: [{'columnName':'name','align':'left','width':'25','label':'Name'}, {'columnName':'country','width':'25','label':'Country'},{'columnName':'state','width':'25','label':'State'}, {'columnName':'city','width':'25','label':'City'}],
		select: function( event, ui ){
			//$( "#search_field" ).val( ui.item.name );
			document.location.href=ui.item.link;
			return false;
		}
	});});
</script>
</head>
<body>
<?php 

//insert google analytic code
include($ga_file); 

?>


<div id="body" style="margin-top:150px">

<?php
            //put navigation
            include(get_module_path("nav/nav.php"));
            $nav=new nav();
            $nav->get_nav_3($lu);
            
            ?>


<div id="readinlist" class="nice_scroll"></div>
<div id="msg"></div>
<div id="reun">
<li id="unread" onclick="sender_receiverlist('unread');">Unread Msgs<img  id="imgunread" src="up.png"></li><li id="read" onclick="sender_receiverlist('read');">Read Msgs<img  id="imgread" src="up.png"></li><li id="sent" onclick="sender_receiverlist('sent');">Sent Msgs<img  id="imgsent" src="up.png"></li></div>
<div align='right' class="bottombar"><table><tr ><td><a id="fback_bbar" title="Give your feedback, let us know what you think about this website" href="user_feedback.php"><img src='feedback.png' align='middle'>&nbsp;Give your feedback</a></td></tr></table></div>
<?php
pop_up_msg($_SESSION['userid']);
?>
</div>
<div id="userinfo"></div><div id="success"></div><div id="uploading"></div>
</body>
</html>