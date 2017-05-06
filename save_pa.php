<?php

include("environment.php");
check_auth();

if(!empty($_POST['vuid'])) 
{

if(if_exists("userdata","id",$_POST['vuid']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['vuid']) && if_exists("authorityrecpients4user".$_SESSION['userid'],'recpient_id',$_POST['vuid'],$authority_recpients_db) && if_exists("authorityrecpients4user".$_POST['vuid'],'recpient_id',$_SESSION['userid'],$authority_recpients_db))
{

if(!empty($_POST['back_strip_color']))
{
if(update_entity("userdata","id",$_POST['vuid'],"back_strip_color",$_POST['back_strip_color']))
echo "1";
else die("failed");
}

if(!empty($_POST['visit_buttonset']))
{
if(update_entity("userdata","id",$_POST['vuid'],"visit_buttonset",$_POST['visit_buttonset']))
echo "1";
else die("failed");
}


if(!empty($_POST['visit_backg']))
{
if( update_entity("userdata","id",$_POST['vuid'],"visit_backg",$_POST['visit_backg']))
echo "1";
else die("failed");
}

if(!empty($_POST['comments_backg']))
{
if(update_entity("userdata","id",$_POST['vuid'],"comments_backg",$_POST['comments_backg']))
echo "1";
else die("failed");
}

if(!empty($_POST['rel_color']))
{
if(update_entity("userdata","id",$_POST['vuid'],"rel_color",$_POST['rel_color']))
echo "1";
else die("failed");
}

$d=date('Y-m-d H:i:s');
if(update_entity("authorityrecpients4user{$_POST['vuid']}","recpient_id",$_SESSION['userid'],"last_change_made",$d,$authority_recpients_db))
echo "1";
else echo "failed";

//handling notification e-mail
email_news($_POST['vuid'],"pac");

//inserting new news into news4user table
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($mysqli->query("insert into news4user{$_POST['vuid']} (news,from_id,when1 ) values ('pac','{$_SESSION['userid']}','{$d}')")===false)
echo "failed";
}

else 
{
header('location:home.php');
}


}


else 
{
header('location:home.php');
}
?>