<?php

include("environment.php");

//verifying log-in
check_log_in($_SERVER["REQUEST_URI"]);

//function to return the path of randomly chosen background image 
function return_backgImage($dir){$files=scandir($dir);foreach ($files as $key => $value) {if (empty($value) || $value==".." ||$value==".")unset($files[$key]); }array_multisort($files);$n=array_rand($files,1);if(file_exists("{$dir}/{$files[$n]}"))echo "{$dir}/{$files[$n]}";else echo "{$dir}/1.jpg";}

include('class_lib.php');
$lu=new user(uid());

?>

<!doctype html><html><head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><META HTTP-EQUIV="Content-Language" Content="en"><meta name="keywords" content="social network,social networking,social web application,new social networking,new social network,have fun,new social web application,feedback frendsdom.com,feedback,contact frendsdom.com,contact" /><meta name="description" content="social web application,feedback to website" /><link rel="icon" href="<?php echo get_image("favicon.ico"); ?>"><title>Feedback to Frendsdom</title><script src="jquery-1.4.js" type="text/javascript"></script><script src="script.js" type="text/javascript"></script>
<script src="jquery.hovercard.js" type="text/javascript"></script><script src="visit_script.js" type="text/javascript"></script><script src="visit_script1.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script><script type="text/javascript" src="resources/jquery/jquery-ui-1.9.2.custom.min.js"></script><script src="js/jquery.outside.events.js"></script><script src="apprise/apprise.min.js" type="text/javascript"></script>
<script type="text/javascript" src="resources/jquery/js.js"></script><script type="text/javascript" src="resources/plugin/jquery.ui.combogrid-1.6.2.js"></script><script type="text/javascript" src="jquery.flexibleArea.js"></script><script type="text/javascript" src="chat/chat.js"></script><script type="text/javascript" src="noty/js/jquery.noty.js"></script><script type="text/javascript" src="noty/js/layouts/bottomLeft.js"></script><script type="text/javascript" src="noty/js/themes/default.js"></script><link rel="stylesheet" type="text/css" href="css8.css"><link rel="stylesheet" type="text/css" href="visit_styleSheet.css">
<link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery.ui.combogrid.css"/><link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.8.9.custom.css"/><link type="text/css" rel="stylesheet" media="all" href="apprise/apprise.min.css" /><link rel="stylesheet" type="text/css" href="chat/chat.css"/>
<style type="text/css">                                                                                       
#user_response_div{background:#eee}#user_comments_container{position:relative;top:5px;}.chatboxhead {
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $lu->get_visit_backg(); ?>', endColorstr='#000000');
background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $lu->get_visit_backg(); ?>), to(#000));
background: -moz-linear-gradient(top,  <?php echo $lu->get_visit_backg(); ?>,  #000);	
}.chatboxtextareaselected {border: 2px solid <?php echo $lu->get_visit_backg(); ?>;
}.plain_back {box-shadow:2px 2px 13px !important}#profile_comments{position:relative !important;top:0px !important;left:0px !important;padding:0px 6px;}.comment{box-shadow:5px 5px 10px #000 !important;border-radius:0px !important;}
</style>
<script type="text/javascript">user_online(); $(function(){$('*[title]').monnaTip()});$(".flexible_textarea").live("focus",function(){$(this).flexible();});
jQuery(document).ready(function(){
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
changecss(0,'.comment','background','<?php echo $lu->get_comment_backg();?>');
</script>
</head>
<body>
<?php 

//insert google analytic code
include($ga_file); 

?>
<div id="body" style="margin-top:107px">

<?php
            //put navigation
            include(get_module_path("nav/nav.php"));
            $nav=new nav();
            $nav->get_nav_3($lu);
            
            ?>

<div class="page-caption" >Give your feedback, let us know your opinion</div>
<center>
<table style="margin-top:25px">
<tr>
<td>

<div id="user_response_div" class="user_response_div response_div"><h3 id="response_h">User's response</h3><?php $lu->userResponseOnWebsite("user_response_div");?></div>

</td></tr>

<tr>
<td>
<table id='profile_comments' class='comment'></table>
</td>
</tr>
</table>
</center>

<?php
pop_up_msg($_SESSION['userid']);
?>
<?php get_footer_1(true); ?>
</div>
<iframe id='fback_statistic' name='fback_statistic' class='hidden' style='position:fixed;top:60px;right:350px;width:500px;height:460px;background:#eee;border:10px solid #eee;box-shadow:5px 5px 10px #000;'></iframe><div id='fback_from' class='background2'></div><div id="success"></div><div id="userinlistmsg"></div><div id="userinfo"></div><p id="uploading" >Uploading your clip......<br/></p><p id="result"></p>
</body></html>