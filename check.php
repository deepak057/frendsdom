<?php

include("environment.php");

if((isset($_POST['user'])) && (isset($_POST['pass'])))
{

if(isset($_POST['loggedin']))
$_POST['loggedin']=true;
else $_POST['loggedin']=false;

if(is_login_valid(htmlentities(trim($_POST['user'])),sha1(trim($_POST['pass'])),$_POST['loggedin']))
{
header("location:home.php");
}

//if no combination matched
else
{
?>
<!doctype html>
<html>
<head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><META HTTP-EQUIV="Content-Language" Content="en"><link rel="icon" href="<?php echo get_image("favicon.ico"); ?>"><title>Logging in-Frendsdom</title>
<link rel="stylesheet" type="text/css" href="css8.css"/>
</head>
<body>
<?php get_header_1(); ?>
<center>
<table  cellspacing="0" cellpadding="50" class="login-form">
<th class="shaded_grey_back">Attempt to log in failed: Invalid username or password</th>
<tr>
<td align="center" class="eee"> 
<p style="color:red;"></br><u>You can try again</u></p>
<p><form method="POST" action="check.php">
<br>Enter your email here
<input type="text" class="shaded_fields" name="user" size=22 ></p>
<h3><pre>
        Password  <input class="shaded_fields" type="password" name="pass" size=22>
</pre></h3>
<br>
<input type="checkbox" name="loggedin" value="true" >Keep me logged in
</br></br><input class="ss-submit special_btn" type="submit" value="Login">
</form><a class='bottom_link' href="forgot_pswd.php">Forgot your password?</a>
</td></tr>
</table>
</center>
<?php get_footer_1(); ?>
</body>
</html>
<?php
}

}

else
{
?>
<!doctype html>
<html>
<head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><META HTTP-EQUIV="Content-Language" Content="en"><link rel="icon" href="<?php echo get_image("favicon.ico"); ?>"><title>Logging in-Frendsdom.com</title>
<link rel="stylesheet" type="text/css" href="css8.css"/>
</head>
<body>
<?php get_header_1(); ?>
<center>
<table cellspacing="0" cellpadding="50" class="login-form">
<th class="shaded_grey_back">Attempt to log in failed: You didn't enter user name and password</th>
<tr>
<td align="center" class="eee"> 
<p style="color:red;"></br><u>You can try again</u></p>
<p><form method="POST" action="check.php">
<br>Enter your email here
<input type="text" class="shaded_fields" name="user" size=22 ></p>
<h3><pre>
        Password  <input class="shaded_fields" type="password" name="pass" size=22>
</pre></h3>
<br>
<input type="checkbox" name="loggedin" value="true" >Keep me logged in
</br></br><input class="ss-submit special_btn" type="submit" value="Login">
</form>
</p><a class='bottom_link' href="forgot_pswd.php">Forgot your password?</a>
</td></tr>
</table>
</center>
<?php get_footer_1(); ?>
</body>
</html>
<?php
}
?>