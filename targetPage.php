<?php

include("environment.php");

if(empty($_SESSION["userid"]))
{
if(isset($_GET['target']))
{
?>
<!doctype html>
<html lang="en">
<head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><link rel="icon" href="<?php echo get_image("favicon.ico"); ?>"><title>Logging in-Frendsdom.com</title>
<link rel="stylesheet" type="text/css" href="css8.css"/>
</head>
<body>
<?php get_header_1(); ?>
<center>
<table cellspacing="0" cellpadding="50" class="login-form">
<th class="shaded_grey_back">You have to log in first to view this page</th>
<tr>
<td align="center" class="eee"> 
<p><form method="POST" action="targetPage.php">
<br>Enter your email here
<input class="shaded_fields" type="text" name="user" size=22 ></p>
<h3><pre>
        Password  <input class="shaded_fields" type="password" name="pass" size=22>
</pre></h3>
<br>
<input type="checkbox" name="loggedin" value="yes" >Keep me logged in
<input type="hidden" name="target" value="<?php echo $_GET['target'];?>">
<br/><br/><input class="ss-submit special_btn" type="submit" value="Login">
</form>
<a class='bottom_link' href="forgot_pswd.php">Forgot your password?</a>
</td></tr>
</table>
</center>
<?php get_footer_1(); ?>
</body>
</html>
<?php

}


if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['target']))
{

if(isset($_POST['loggedin']))
$_POST['loggedin']=true;
else $_POST['loggedin']=false;

if(is_login_valid(htmlentities(trim($_POST['user'])),sha1(htmlentities(trim($_POST['pass']))),$_POST['loggedin']))
{
header("location:{$_POST['target']}");
}
else 
{
?>
<!doctype html>
<html lang="en"><head><meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<link rel="icon" href="<?php echo get_image("favicon.ico"); ?>"><title>Logging in-Frendsdom</title>
<link rel="stylesheet" type="text/css" href="css8.css"/>
</head>
<body>
<?php 

//insert google analytic code
include($ga_file); 

?>
<?php get_header_1(); ?>
<center>
<table cellspacing="0" cellpadding="50" class="login-form">
<th class="shaded_grey_back">Attempt to login failed: Invalid user email or password </th>
<tr>
<td align="center" class="eee">
<p style="color:red;"><br/><u>You can try again</u></p> 
<p><form method="POST" action="targetPage.php">
<br>Enter your email here
<input class="shaded_fields" type="text" name="user" size=22 /></p>
<h3><pre>
        Password  <input class="shaded_fields" type="password" name="pass" size=22/>
</pre></h3>
<br>
<input type="checkbox" name="loggedin" value="yes" >Keep me logged in
<input type="hidden" name="target" value="<?php echo $_POST['target'];?>">
<br/><br/><input class="ss-submit special_btn" type="submit" value="Login">
</form>
<a class='bottom_link' href="forgot_pswd.php">Forgot your password?</a>
</td></tr>
</table>

</center>
<?php get_footer_1(); ?>
</body>
</html>
<?php
}
}
}
else
{
if(isset($_GET['target']))
header("location:{$_GET['target']}");
}
?>