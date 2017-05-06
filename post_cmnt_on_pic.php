<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_id']) && !empty($_POST['pic_id']) && !empty($_POST['comment']) && !empty($_POST['id']))
{

//filtering the comment received
$_POST['comment']=addslashes(htmlentities(trim($_POST['comment'])));

$d=date('Y-m-d H:i:s');

$mysqli=new mysqli($host,$db_user,$db_passwd,$picdata_db);
if($mysqli===false)
{
die("Could not connect to database");
}
if($mysqli->query("insert into {$_POST['pic_id']} (fromid,comment,when1) values('{$_SESSION['userid']}','{$_POST['comment']}','{$d}')"))
{

if($_SESSION['userid']!=$_POST['id'])
{

//incrementing user's points by one
update_points($_POST['id'],1);

$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
if($mysqli->query("insert into news4user{$_POST['id']} (news,from_id,when1 ) values ('commentOnpic*col_id={$_POST['col_id']}&pic_id={$_POST['pic_id']}*".entity_value($_POST['pic_id'],"comment_index","when1",$d,$picdata_db)."','{$_SESSION['userid']}','{$d}')"))
{

//handling e-mail news
email_news($_POST['id'],"commentOnpic");


echo "1";

}else echo "0";

}

else echo '1';

}

else echo "0";


}
else
{
header('location:home.php');
}
?>