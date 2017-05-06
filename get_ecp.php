<?php

include("environment.php");
check_auth();

mysql_connect($host,$db_user,$db_passwd);
mysql_select_db($eyecandy_db);
$query= "SELECT `pic_data_thumb`,`pic_data`, `pic_type` FROM eyecandy_pics_of_user{$_SESSION['userid']} WHERE pic_id='{$_GET['pic_id']}'";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_object($result);
header('Content-type:'. $row->pic_type);
if(!empty($_GET['size']) && $_GET['size']=="big")
echo $row->pic_data;
else 
{
echo $row->pic_data_thumb;
}
?>