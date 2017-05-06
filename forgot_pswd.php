<?php

include("environment.php");

//if logged-in cookies are found on client's system then refer user to home page
to_home();

//keeping record of user's visit
keep_track();

//function to return the path of randomly chosen background image 
function return_backgImage($dir){$files=scandir($dir);foreach ($files as $key => $value) {if (empty($value) || $value==".." ||$value==".")unset($files[$key]); }array_multisort($files);$n=array_rand($files,1);if(file_exists("{$dir}/{$files[$n]}"))echo "{$dir}/{$files[$n]}";else echo "{$dir}/1.jpg";}

//compressing HTML content 
//ob_start("ob_gzhandler"); 

?>
<!doctype html>
<html>
<head><link rel="icon" href="<?php echo get_image("favicon.ico"); ?>"><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><META HTTP-EQUIV="Content-Language" Content="en"><meta name="keywords" content="frendsdom,social network,social networking,social web application,new social networking,new social network,have fun,new social web application,top social networking,best social networking,top social network" /><meta name="description" content="social web application,sign up,log in" />
<title>Reset Your Password- Frendsdom</title><link rel="stylesheet" type="text/css" href="css8.css"/><link rel="stylesheet" type="text/css" href="main_stylesheet.css"/><script src="jquery-1.4.js" type="text/javascript"></script><script src="script.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script>
<script>
$(function(){$('*[title]').monnaTip()});function show_info(){el('intro_btn').onclick=function(){hide_info()};if(inner('info_container').length<1){show('info_container');el('info_container').innerHTML="<tr><td>"+loading+"</td></tr>";el('intro_btn').style.background="grey";el('info_container').innerHTML="<tr><td>"+responsetext("","introduction.php")+"</td></tr>";$("#info_container").hide();$("#info_container").show("slow")}else{el('intro_btn').style.background="grey";$("#info_container").hide();$("#info_container").show("slow")}}function hide_info(){el('intro_btn').onclick=function(){show_info()};el('intro_btn').style.background="#206E8A";$("#info_container").hide("slow")}function checkemailid(a){var b=1;var c=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;var d=/^(.+)@(.+)$/;var e="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";var f="\[^\\s"+e+"\]";var g="(\"[^\"]*\")";var h=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;var j=f+'+';var k="("+j+"|"+g+")";var l=new RegExp("^"+k+"(\\."+k+")*$");var m=new RegExp("^"+j+"(\\."+j+")*$");var n=a.match(d);if(n==null){return false}var o=n[1];var p=n[2];for(i=0;i<o.length;i++){if(o.charCodeAt(i)>127){return false}}for(i=0;i<p.length;i++){if(p.charCodeAt(i)>127){return false}}if(o.match(l)==null){return false}var q=p.match(h);if(q!=null){for(var i=1;i<=4;i++){if(q[i]>255){return false}}return true}var r=new RegExp("^"+j+"$");var s=p.split(".");var t=s.length;for(i=0;i<t;i++){if(s[i].search(r)==-1){return false}}if(b&&s[s.length-1].length!=2&&s[s.length-1].search(c)==-1){return false}if(t<2){return false}return true}$("#send_email_btn").live("click",function(){if(el('email').value.length<1){alert('Are you sure you have specified your email? Please check.');el('email').focus();return}else if(!checkemailid(el('email').value)){alert("Email specified doesn't seem to be valid one. Please correct it");el('email').focus();return}el('mail_status').setAttribute("class","status_msg center");el('mail_status').innerHTML="<img src='picon1.gif' >&nbsp;Please wait...... ";w.postMessage("pswd_restore_mail email="+el('email').value);w.onmessage=function(e){if(parseInt(e.data)==1){el('mail_status').innerHTML="<b>Successful:</b> an email has been sent to <b>"+el('email').value+"</b>. Please go there and follow the instructions.<br/>In case you don't receive an email please press the button below again.";el('send_email_btn').value='Resend email'}else{el('mail_status').innerHTML='<b>Error:</b> failed to send email to <b>'+el('email').value+'</b>';el('send_email_btn').value='Done,send email'}}});
</script>
</head>

<body>
<?php 

//insert google analytic code
include($ga_file); 

get_header_1();

?>

<div class="center">
<div class="page-caption">Change Password</div>
<p id='mail_status' class="center">Please specify your email which you signed up with on Frendsdom</p>
<p>
<input type="email" id="email" size="30" placeholder="Enter email" class="shaded_fields"/></p>
<p>
<input type="button" value="Done,send email" id="send_email_btn" class='special_btn'>
</p>
</div>
<table id='info_container' class='hidden'></table>
<?php get_footer_1(true); ?>
</body>
</html>
