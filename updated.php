<?php


include("environment.php");
check_auth();

if(!empty($_POST['first'])&& !empty($_POST['last'])&& !empty($_POST['sex'])&& !empty($_POST['day'])&& !empty($_POST['month'])&& !empty($_POST['year'])&& !empty($_POST['email'])&& !empty($_POST['country'])&& !empty($_POST['state'])&& !empty($_POST['city']))
{


//function to display the message in case of failure
function diemsg($email){echo "<b>Error:</b> Failed to create your database</br><a href='/signup.php'>You can try again</a>";die("");}

//retreiving data required to be verified first
$day=htmlentities(trim($_POST['day']));
$month=htmlentities(trim($_POST['month']));
$year=htmlentities(trim($_POST['year']));
$email=htmlentities(trim($_POST['email']));
$pass1=htmlentities(trim($_POST['pass1']));
$pass2=htmlentities(trim($_POST['pass2']));

if(checkdate ($month ,$day ,$year )  && checkemail($email) && validemail($_SESSION['userid'],$email))
{
$first=entryfordatabase(ucwords(htmlentities(trim($_POST['first']))));
$last=entryfordatabase(ucwords(htmlentities(trim($_POST['last']))));
$sex=$_POST['sex'];
$country=ucwords(htmlentities(trim($_POST['country'])));
$state=ucwords(htmlentities(trim($_POST['state'])));
$city=ucwords(htmlentities(trim($_POST['city'])));
$text=null;

//checking if email address has been updated
if($email!=entity_value("userdata","user_id","id",$_SESSION['userid']))
{
include('class_lib.php');
$lu=new user($_SESSION['userid']);
$data=sha1(md5(date('Y-m-d H:i:s')."_".$lu->get_password()."_{$email}"));

if(update_entity("userdata","id",$_SESSION['userid'],"email_verified",$data))
{
send_verification_mail($email,"id={$_SESSION['userid']}&data={$data}");
$text="<p><b>Hey! you have changed your email</b>.</p><p>We have sent a confirmation link to your new email address (<b>{$email}</b>). Please verify it by following the instructions contained in that email.</p><p> In case you think you entered invalid/incorrect email address maybe by mistake , you still have a chance to correct it before leaving this page.</p>";
}
}


if(!empty($pass1) && !empty($pass2) &&($pass1==$pass2))
{
//encrypting password by sha1 algorithm
$pass=sha1($pass1);
$sql="update userdata set user_id='{$email}',first=$first ,last=$last,sex='{$sex}',day='{$day}',month='{$month}',year='{$year}',password='{$pass}',country='{$country}',state='{$state}',city='{$city}',last_profile_update=NOW() where id='{$_SESSION['userid']}'";             
}

else 
{
$sql="update userdata set user_id='{$email}',first=$first ,last=$last,sex='{$sex}',day='{$day}',month='{$month}',year='{$year}',country='{$country}',state='{$state}',city='{$city}',last_profile_update=NOW() where id='{$_SESSION['userid']}'";             
}


//iupdating table userdata
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("Could not connect to database");
}
if($mysqli->query($sql)===false)
{
die("<h3><font color='red'>Error: Can't update your profile</font></h3>.</br>Please check the information provided by you carefully and make sure every bit of it is valid.</br>Check the email specified ,it is very likely that it's already registered with <a href='".SITE_URL."'>Frendsdom</a></br></br><input type='button' value='OK' class='btn' onclick='go_back();'>");
}
else 
{
echo "<h3><img src='checkmark.gif' height='30' width='30' align='middle'>&nbsp;<font color='green'>Changes successfully saved</font></h3>{$text}</br><input type='button' value='Done' onclick='go_back();' class='btn'>";
}
}

else
{
die("<h3><img src='alert.gif' align='middle'><font color='red'>Error: Can't update your profile</font></h3>.</br>Please check the information provided by you carefully and make sure every bit of it is valid.</br>Check the email specified ,it is very likely that it's already registered with <a href='".SITE_URL."'>Frendsdom</a></br></br><input type='button' value='OK' class='btn' onclick='go_back();'>");
}

}

else
{
header('location:main.php');
}