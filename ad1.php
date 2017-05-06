<?php

include('environment.php');
check_auth();

if((!empty($_POST['action'])) && (!empty($_POST['requestid'])) && (if_exists("user".$_SESSION['userid'],'requestid',$_POST['requestid'])) && ( !if_alreadyexists($_SESSION['userid'],$_POST['requestid'])))
{

//collecting required data
$action=$_POST['action'];
$request=$_POST['requestid'];
$type=entity_value("user".$_SESSION['userid'],'type','requestid',$request);
$points=entity_value("user".$_SESSION['userid'],'points','requestid',$request);
if(!$points){$points=0;}

//database connection 
$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);if($mysqli===false){die("<p>Error :".mysqli_connect_error());}

switch($_POST['action'])
{
case "add":
if($mysqli->query("update user{$_SESSION['userid']} set requestid='',type='',{$type}id='{$request}',listid='{$request}',when1='".date('Y-m-d H:i:s')."'  where requestid='{$request}'") && $mysqli->query("insert into user{$request} ({$type}id ,listid,when1) values('{$_SESSION['userid']}','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')"))
{

//updating invitee's points
update_points($_SESSION['userid'],($points+1));

//updating invitor's points
update_points($request,1);

//putting new posts in both invitor's and invitee's status view
put_new_posts($_SESSION['userid'],$request);

//inserting new news
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
if($mysqli->query("insert into news4user{$request} (news,from_id,when1 ) values ('invitetion_accepted','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')")){

//handling notification e-mail
email_news($request,"invitetion_accepted");

echo "success";

}
else echo "failed";
}
else echo "failed";
break;

case "reject":
if($mysqli->query("delete from user{$_SESSION['userid']} where requestid='{$request}'"))
{

//releasing invitor's points
if($points>0){
update_points($request,$points);
}

$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
if($mysqli->query("insert into news4user{$request} (news,from_id,when1 ) values ('invitetion_rejected','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')")){

//handling notification e-mail
email_news($request,"invitetion_rejected");

echo "success";

}
else echo "failed";
}
else
echo "failed to reject";
break;
}
}
else
{
header('location:home.php');
}
?>