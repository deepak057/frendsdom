<?php

include("environment.php");
check_auth();

if(!empty($_POST['p_id']) &&  !empty($_POST['fback']))
{

//extracting post owner's id from post_id
$owner_id=explode("_",$_POST['p_id']);
$owner_id=$owner_id[1];


if(in_array($_POST['fback'],array("like","best","awesome")))
{

if(in_array($_SESSION['userid'],return_array_tweaked($fback_to_posts_db,$_POST['p_id'],"fromid")))
{

if($_SESSION['userid']!=$owner_id)
{
//deducing points
update_points($owner_id,get_points_for_fback(entity_value($_POST['p_id'],"fback","fromid",$_SESSION['userid'],$fback_to_posts_db)),"deduce");
}

//updating user's feedback
update_entity($_POST['p_id'],"fromid",$_SESSION['userid'],"fback",$_POST['fback'],$fback_to_posts_db);

}

else
{
//database connection
$mysqli =new mysqli($host,$db_user,$db_passwd,$fback_to_posts_db);
$mysqli->query("insert into {$_POST['p_id']} (fromid,fback,when1) values ({$_SESSION['userid']},'{$_POST['fback']}','".date('Y-m-d H:i:s')."')");
}

if($_SESSION['userid']!=$owner_id)
{
//adding points
update_points($owner_id,get_points_for_fback($_POST['fback']));

//inserting new news into news4user table of post's owner
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
$mysqli->query("insert into news4user{$owner_id} (news,from_id,when1 ) values ('fback2post*{$_POST['p_id']}','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')");

//handling notification e-mail
email_news($owner_id,"fback2post");
}

//confirming success
echo "1";

}

else
{

if($_SESSION['userid']!=$owner_id)
{
//deducing points
update_points($owner_id,get_points_for_fback(entity_value($_POST['p_id'],"fback","fromid",$_SESSION['userid'],$fback_to_posts_db)),"deduce");
}

//removing feedback entry
delete_row($_POST['p_id'],"fromid",$_SESSION['userid'],$fback_to_posts_db);

//confirming success
echo "1";

}


}

else
{
header("location:home.php");
}
?>