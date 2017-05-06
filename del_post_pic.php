<?php

include("environment.php");
check_auth();

if(!empty($_POST['pic_id'])) 
{

//making sure that only owner can delete this picture
$temp=explode("_",$_POST['pic_id']);
if($temp[1]!=$_SESSION["userid"]){
die("0");
}

//database connection
$mysqli=new mysqli($host,$db_user,$db_passwd,$post_pic_data);

//dropping post's picture table
if($mysqli->query("drop table {$_POST['pic_id']}"))
{
echo "1";
}
else{
echo "0";
}

}
else 
{
header('location:home.php');
}
?>