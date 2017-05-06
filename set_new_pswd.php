<?php

include("environment.php");

//if logged-in cookies are found on client system then referring user to home page
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
<script type="text/javascript">$(function(){$('*[title]').monnaTip();});                                                           
function show_info(){el('intro_btn').onclick=function(){hide_info()};if(inner('info_container').length<1){show('info_container');el('info_container').innerHTML="<tr><td>"+loading+"</td></tr>";el('intro_btn').style.background="grey";el('info_container').innerHTML="<tr><td>"+responsetext("","introduction.php")+"</td></tr>";$("#info_container").hide();$("#info_container").show("slow")}else{el('intro_btn').style.background="grey";$("#info_container").hide();$("#info_container").show("slow")}}function hide_info(){el('intro_btn').onclick=function(){show_info()};el('intro_btn').style.background="#206E8A";$("#info_container").hide("slow")}
$("#set_pswd_btn").live("click",function(){if(trim(el('pass1').value).length<1){alert('Please enter the new password');el('pass1').focus();return;}if(trim(el('pass2').value).length<1){alert('Please Confirm the new password');el('pass2').focus();return;}if(trim(el('pass1').value)!=trim(el('pass2').value)){alert("Re-enterd password didn't match.Please correct it");el('pass2').focus();return;
}el('mail_status').setAttribute("class","status_msg center");el('mail_status').innerHTML="<img src='picon1.gif' >&nbsp;Please wait...... ";w.postMessage("confirm_new_pswd <?php echo "email={$_GET['email']}&id={$_GET['id']}&k={$_GET['k']}" ;?>&pass="+encodeURIComponent(trim(el('pass1').value)));
w.onmessage=function(e){if(parseInt(e.data)==1){el('mail_status').innerHTML="<b>Successful:</b> New password has been set. You may <a href='main.php'><b>login</b></a> with new password to continue.";el('r').innerHTML='<form name="login" action="check.php" method="POST"><b>Email Id</b> &nbsp&nbsp&nbsp&nbsp<input class="shaded_fields" type="email" name="user" size="30"/><br/><br/><b>Password</b>&nbsp&nbsp<input class="shaded_fields" type="password" name="pass" size="30"/><br/><br/><input type="checkbox"  name="loggedin" value="true" />Keep me Logged In<br/><br/><center><input class="rounded_btn pointer login_btn" type="submit" value="LOGIN" name="login"/></center></form>';$("#r").hide();$("#r").show("slow");}else {
el('mail_status').innerHTML='<b>Error:</b> failed to set new password';}};});
</script>
</head>

<body>

<?php

//insert google analytic code
include($ga_file); 

//put header
get_header_1();

?>
<div class="center">
<div class="page-caption">Set New Password</div>
<p id="mail_status">

<?php 
if(!empty($_GET['email']) && !empty($_GET['id']) && !empty($_GET['k']) &&  entity_value("forgot_pswd_table","encrypted_key","email",$_GET['email'],$other_data_db)==$_GET['k'])
{
echo "Hello ".entity_value("userdata","first","user_id",$_GET['email']).", set a new password";
?>
</p>
<div id="r">
<p>
<input type="password" id="pass1" class="shaded_fields" size="30" placeholder="New Password"/><br/>
</p>
<p>
<input type="password" id="pass2" size="30" class="shaded_fields" placeholder="Confirm Password"/><br/>
</p>
<p><input type="button" value="Set New Password" id="set_pswd_btn" class='special_btn'></p>
</div>
<?php
}
else {
echo "<p class='status_msg center'>Error: Invalid/expired data supplied</p>";
}

?>
</div>
<table id='info_container' class='hidden'></table>
<?php get_footer_1(true); ?>
</body>
</html>