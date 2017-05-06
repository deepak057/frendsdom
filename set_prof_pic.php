<?php

include("environment.php");
check_auth();

if(!empty($_POST['pic_url'])) 
{

$_POST['pic_url']=trim($_POST['pic_url']);
if(!remoteFileExists($_POST['pic_url']) || !isImage($_POST['pic_url']))
{
die("failed");
}
$pic_name=basename($_POST['pic_url'],".".get_file_type($_POST['pic_url'])).PHP_EOL;
$pic_data=file_get_contents($_POST['pic_url']);
$pic_type=get_file_type($_POST['pic_url'],"type");
//$pic_size=strlen($pic_data);

if(set_prof_pic($pic_type,$prof_pic_size,$pic_name,$pic_data))
{
$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);
if($mysqli->query("update userdata set picture='yes',home_pic_view='prof_pic' where id={$_SESSION['userid']}"))
{
echo prof_pic($_SESSION['userid'],"original");
}
else echo 'failed';
}
else
{
echo 'failed';
}
}
else
{
header('location:home.php');
}
?>