<?php

include("environment.php");
check_auth();

if(!empty($_POST['public']) && in_array($_POST['public'],array("y","n")) && !empty($_POST['save_pv_conf']) && !empty($_POST['pv_rel']) && !empty($_POST['post_content']))
{

//manipulating variables for database
if($_POST['public']=="y")$_POST['public']=1;else $_POST['public']=0;
if(empty($_POST['pv_excluded']))$_POST['pv_excluded']='';
if(empty($_POST['cat']))$_POST['cat']=0;


$mysqli =new mysqli($host,$db_user,$db_passwd,$conf_db);
if($_POST['save_pv_conf']=="y")
{
//saving post visibility configuration
$mysqli->query("update user_conf set public={$_POST['public']},save_pv_conf=1,relations='{$_POST['pv_rel']}',excluded='{$_POST['pv_excluded']}' where id={$_SESSION['userid']}");
}
else
{
$mysqli->query("update user_conf set save_pv_conf=0 where id={$_SESSION['userid']}");
}


//saving post content along with its visibility configuration
$mysqli =new mysqli($host,$db_user,$db_passwd,$posts_db);
$post_id="post_{$_SESSION['userid']}_".mktime();

//current datetime stamp
$date=get_date_time();

if($mysqli->query("insert into posts_record_of_user{$_SESSION['userid']} (post_id,post_content,pic_id,news_id,movie_id,video_id,created,public,relations,excluded,cat) values ('{$post_id}','".$mysqli->real_escape_string(htmlentities(trim($_POST['post_content'])))."','{$_POST['post_pic_id']}','{$_POST['post_news_id']}','{$_POST['post_movie_id']}','{$_POST['post_video_id']}','{$date}','{$_POST['public']}','{$_POST['pv_rel']}','{$_POST['pv_excluded']}',{$_POST['cat']})"))
{

//creating table for holding feedback record for this post
$mysqli =new mysqli($host,$db_user,$db_passwd,$fback_to_posts_db);
$mysqli->query("create table {$post_id} (fromid bigint unsigned primary key,fback varchar (10) not null, when1 datetime)");

//creating table for holding comment record for this post
$mysqli =new mysqli($host,$db_user,$db_passwd,$cmnt_on_posts_db);
$mysqli->query("create table {$post_id} (comment_index int unsigned auto_increment primary key,fromid bigint unsigned,comment_id varchar(50) not null,comment text(1000), when1 datetime)");


//now keep track of Category in which this post was tagged in
$mysqli =new mysqli($host,$db_user,$db_passwd,$cats_post_records_db);
$mysqli->query("insert into cats_post_records (`post_id`,`cat_id`,`date`,`from_id`) values ('{$post_id}',{$_POST['cat']},'{$date}',".uid().")");


//updating status view table of relations
$rel_list=return_array("user{$_SESSION['userid']}","listid");
array_push($rel_list,uid());
$mysqli =new mysqli($host,$db_user,$db_passwd,$status_view_db);
for($i=0;$i<sizeof($rel_list);$i++)
{
$mysqli->query("insert into status_view_of_user{$rel_list[$i]} (fromid,post_id,`date`) values({$_SESSION['userid']},'{$post_id}','{$date}')");
}

echo $post_id;
}
else echo "failed";
}

else 
{
header('location:home.php');
}

?>