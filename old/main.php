<?php

session_start();
//if logged-in cookies are found on client system then referring user to home page
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
<head><meta itemprop="image" content="awesom.bmp"><link rel="shortcut icon" href="awesom.bmp"><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><meta name="keywords" content="frendsdom,social network,social networking,social web application,new social networking,new social network,have fun,new social web application,top social networking,best social networking,top social network,a social web application,new social networking sites" /><meta name="description" content="An emerging colorful social web application with new, colorful and innovative fun features. It allows users to socialize online in ways completely different from those popularized by today's big social networks and aims to be an unique one in the field of social networking ,free to join" /><meta name="author" content="Deepak Mishra" /><meta name="robots" content="index, nofollow" />
<title>New social networking | web application with new and innovative fun features</title><link rel="stylesheet" type="text/css" href="css8.css"/><link rel="stylesheet" type="text/css" href="main_stylesheet.css"/><link rel="canonical" href="https://plus.google.com/u/0/b/112605741449524685695/112605741449524685695/posts" /><script src="script.js" type="text/javascript"></script><script src="jquery-1.4.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script><script type="text/javascript" src="transit.js"></script><script type="text/javascript" src="intro_script_main.js"></script><script type="text/javascript" src="main_script.js"></script>
<style type="text/css">                                                                                       
body{-moz-background-size:100% 100%;}
</style>
</head>
<body>
<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk')); window.___gcfg = {lang: 'en-US'};</script>
<div id='body'>
<table width="100%">
<tr>
<td align='left'><img alt='frendsdom-a colorful social web application' src="frendsdom.gif" width="500" height="80"/></td><td align='right'>
<SCRIPT LANGUAGE="JavaScript1.1" SRC="http://bdv.bidvertiser.com/BidVertiser.dbm?pid=477308&bid=1184196" type="text/javascript"></SCRIPT>
<noscript><a href="http://www.bidvertiser.com">make money online</a></noscript></td>
</tr>
</table>
<hr>
<table width="100%">
<tr>
<td align="right"><td align='left'><table><tr><td><span class='info_btn' onclick='show_info();' id='intro_btn' title='Breif introduction to frendsdom.com'>What is it?</span></td><td><span class='info_btn' id='intro_p' title='know what using Frendsdom is going to be like'>Take a tour</span></td><tr></table></td>
<td align='right'><span id='big_text'>It's free, so&nbsp;&nbsp;</span><a href="signup.php"><img src="signup_btn.jpg" alt="signup" width="80"  height="30" align='middle'></a>
</td>
</tr>
</table>
<hr>
<div class="r">
<h3 align="center">Sign in</h3>
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
<center><input type="image" src="login_btn.jpg" alt="signin"  value="sign in" name="login" width="80"  height="30"/></center>
</form>
<div align='right' style='font-size:.8em;'><a href='http://frendsdom.com/forgot_pswd.php'>Forgot your password?</a></div>
<hr>
<div class="like_btn_container grey_backg rounded_border_r10 shaded_border_thick_grey">Recommend Frendsdom here
<table>
<tr>
<td valign="top">
<fb:like href="http://www.facebook.com/Frendsdom" send="false" layout="button_count" width="450" show_faces="true" font="lucida grande"></fb:like>
</td>
<td valign="bottom">
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

<p>We are growing! See the people who joined Frendsdom very recently</p>
<?php

include('class_lib.php');

$i=0;
echo "<table><tr>";

$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);
if($result=$mysqli->query("select * from userdata order by created desc"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if($i%5==0)
echo "</tr><tr>";
$u=new user($row['id']);
if($u->user_pic())
{
echo "<td itemscope itemtype ='http://schema.org/person'><a itemprop='contactPoint' href='visit.php?id={$row['id']}'><img class='transit_item' alt='".$u->get_name()."' title='".$u->get_name()." from ".$u->get_country()."' src='".$u->prof_pic()."' itemprop='image'></a></td>";
$i++;
}
if($i==20)break;
}
}
}
?>
</table>
<hr>
</div>
<table id='info_container' class='hidden' itemscope itemtype ='http://www.schema.org/Article' itemprop='description'></table>
<div align='right' class='bottombar'>
<script type="text/javascript" src="http://adzly.com/adserve/getadzly.php?awid=6551"></script>
<noscript><a href="http://adzly.com/r/73815">Put your ad here for free! - adzly.com</a></noscript>
</div>
<div align='left' class='bottombar'>
<span style='margin:10px;'>Frendsdom.com &copy; 2012</span>
</div>
</div>
</body>
</html>
