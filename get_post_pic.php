<?php

include("includes/global_vars.php");
//check_auth();

if(!empty($_GET['pic_id']))
{

//connecting to database        
mysql_connect($host,$db_user,$db_passwd);
mysql_select_db($post_pic_data);

//getting data
$result = mysql_query("SELECT `pic_data_thumb`,`pic_data`, `pic_type` FROM {$_GET['pic_id']}") or die("Error: image not found");
$row = mysql_fetch_object($result);

//putting appropriate header
header('Content-type:'. $row->pic_type);

//displaying image

if(!empty($_GET['size']) && $_GET['size']=="big")
echo $row->pic_data;

else 
{
echo $row->pic_data_thumb;
}
}
else 
{
header('location:home.php');
}

?>