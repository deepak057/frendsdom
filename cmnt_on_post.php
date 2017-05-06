<?php

include("environment.php");
check_auth();

if(!empty($_POST['p_id']) && !empty($_POST['comment']))
{

//generating unique id for this comment
$cmnt_id="cmnttopost_{$_SESSION['userid']}_".mktime();

//extracting post owner's id
$owner_id=owner_from_post_id($_POST['p_id']);

//inserting data into database
$mysqli =new mysqli($host,$db_user,$db_passwd,$cmnt_on_posts_db);

if($mysqli->query("insert into {$_POST['p_id']} (fromid,comment_id,comment,when1) values ({$_SESSION['userid']},'{$cmnt_id}','".htmlentities(mysql_escape_string(trim($_POST['comment'])))."','".date('Y-m-d H:i:s')."')"))
{

/**
* array to hold the ids of user that are going to be notified of this comment
*/
$to_be_notified=array();


/**
*get the ids of users that have already commented on this post if any
*/


if($result=$mysqli->query("select distinct(`fromid`) as from_ids from {$_POST['p_id']} where `fromid`!=".uid()." AND `fromid`!={$owner_id}" ))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{

$to_be_notified[]=$row['from_ids'];

}
}
}

/*
* Connect to News database
*/
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);


//incrementing post owner's sum of points by one
if($_SESSION['userid']!=$owner_id)
{
//adding points
update_points($owner_id,"1");

//inserting new news into news4user table of post owner
$mysqli->query("insert into news4user{$owner_id} (news,from_id,when1 ) values ('comment2post*{$_POST['p_id']}*{$cmnt_id}','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')");

//handling notification e-mail
email_news($owner_id,"commentOnPost");

}

/*
* notify others that a new comment has been posted
*/

if(count($to_be_notified)){

foreach($to_be_notified as $uid){

$mysqli->query("insert into news4user{$uid} (news,from_id,when1 ) values ('alsocommented*{$_POST['p_id']}*{$cmnt_id}','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')");

}

}

echo $cmnt_id;
}
else echo "failed";

}
else 
{
header('location:home.php');
}

?>