<?php

session_start();
//if logged-in cookies are found on client's system then redirect user to home page
if ((isset($_COOKIE['usn'])) && (isset($_COOKIE['usk'])) || (!empty($_SESSION["username"]) && !empty($_SESSION["userkey"]) && !empty($_SESSION["userid"])))
{
header('location:home.php');
}

include('/home/frendryg/FunctionList.php');

//keeping record of user's visit
keep_track();

//function to return the path of randomly chosen background image 
function return_backgImage($dir){$files=scandir($dir);foreach ($files as $key => $value) {if (empty($value) || $value==".." ||$value==".")unset($files[$key]); }array_multisort($files);$n=array_rand($files,1);if(file_exists("{$dir}/{$files[$n]}"))echo "{$dir}/{$files[$n]}";else echo "{$dir}/1.jpg";}

//compressing HTML content 
ob_start("ob_gzhandler"); 

?>
<!doctype html>
<html itemscope="itemscope" itemtype="http://schema.org/WebPage" lang="en">
<head><meta charset="utf-8" /><meta itemprop="image" content="awesom.bmp"/><link rel="shortcut icon" href="awesom.bmp"><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><meta name="keywords" content="frendsdom,social network,social networking,social web application,new social networking,new social network,have fun,new social web application,top social networking,best social networking,top social network,a social web application,new social networking sites,find new friends,find people" /><meta name="description" content="An emerging colorful social web application with new, colorful and innovative fun features. It allows users to socialize online in ways completely different from those popularized by today's big social networks and aims to be an unique one in the field of social networking ,free to join" /><meta name="author" content="Deepak Mishra" /><meta name="robots" content="index,follow" />
<title>Frendsdom-A social network to expand your world</title><link rel="stylesheet" type="text/css" href="css8.css"/><link rel="stylesheet" type="text/css" href="main_stylesheet.css"/><link rel="canonical" href="https://plus.google.com/u/0/b/112605741449524685695/112605741449524685695/posts" /><script src="script.js" type="text/javascript"></script><script src="jquery-1.4.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script><script type="text/javascript" src="jquery.flexibleArea.js"></script><script type="text/javascript" src="js/jquery.flex.min.js"></script><script type="text/javascript" src="intro_script_main.js"></script><script type="text/javascript" src="main_script.js"></script>
<style type="text/css">                                                                                       
body{-moz-background-size:100% 100%;}
</style>
</head>
<body>

<?php 

//insert google analytic code
include($ga_file); 

?>

<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk')); window.___gcfg = {lang: 'en-US'};</script>
<div id='body'>
<table class="full_width">
<tr>
<td class='left'><img alt='frendsdom-a colorful social web application' src="frendsdom.gif" width="500" height="80"/></td><td class='right'>
<?php 

//include ads
include($ad_468_60);

?>
</td>
</tr>
</table>
<hr>
<table class="full_width" cellspacing="5">
<tr>
<td class="right"><td class='left'><table><tr><td><span class='info_btn' onclick='show_info();' id='intro_btn' title='brief introduction to Frendsdom'>What is it?</span></td><td><span class='info_btn' id='intro_p' title='know what using Frendsdom is going to be like'>Take a tour</span></td><td><span class='info_btn' id="cu_btn">Contact Us</span></td></tr></table></td>
<td class='right top'><span id='big_text'>It's free, so&nbsp;&nbsp;</span><a href="signup.php" class="rounded_btn pointer signup_btn">Sign Up</a>
</td>
</tr>
</table>
<hr>
<div class="r">
<h3 class="center">Sign in</h3>
<hr>

<form name="login" action="check.php" method="POST" onsubmit="return validateForm();">
<b>Email Id</b> 
&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="user" size="30"/><br/>
<br/>
<b>Password</b>
&nbsp;&nbsp;<input type="password" name="pass" size="30"/>
<br/><br/>
<input type="checkbox"  name="loggedin" value="true" />Keep me Logged In
<br/><br/>
<div class="center"><input type="submit" name="login" value="LOGIN" class="rounded_btn pointer login_btn"/></div>
</form>
<div class='right' style='font-size:.8em;'><a href='http://frendsdom.com/forgot_pswd.php'>Forgot your password?</a></div>
<hr>
<div class="like_btn_container grey_backg rounded_border_r10 shaded_border_thick_grey">Recommend Frendsdom here
<table>
<tr>
<td class="top">
<fb:like href="http://www.facebook.com/Frendsdom" send="false" layout="button_count" width="450" show_faces="true" font="lucida grande"></fb:like>
</td>
<td class="bottom">
<div class="g-plusone" data-size="tall" data-annotation="inline" data-width="300"></div>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script></td>
</tr>
</table>
</div>
</div>
<div class="l" >
<br/>
<hr>

<span><strong>We are growing! See the people who joined Frendsdom very recently</strong></span></br>
<?php

//putting newest user's picture grid
include('modules/pic_grid/pic_grid.php');

put_new_users_grid();

?>
</div>
<table id='info_container' class='hidden' itemscope itemtype ='http://www.schema.org/Article' itemprop='description'></table>

<div class='copyright'>
<div style='margin:10px;'><a class="underline_onHover" target="_blank" href="<?php echo get_blog_url();?>">Visit our blog</a> | Frendsdom.com &copy; 2013</div>
</div>

</div>
</body>
</html>
