<?php

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['ps_news_db']);

//derive unique id for this news
$news_id="psnews_{$_SESSION['userid']}_".mktime();

//retreive content
$title=$mysqli->real_escape_string(trim($_REQUEST['title']));
$des=$mysqli->real_escape_string(trim($_REQUEST['description']));
$content=$mysqli->real_escape_string(trim($_REQUEST['content']));
$url=empty($_REQUEST['url'])?'':trim($_REQUEST['url']);

//create table for holding news content if not already exists
$mysqli->query("create table IF NOT EXISTS `news`  (`id` bigint unsigned not null auto_increment primary key,`news_id` varchar(100) not null,`created_by` bigint unsigned not null,`title` text(500),`description` text(1000),`content` text(5000),`created` datetime,`url` text(500))");

//insert content
if($mysqli->query("insert into `news` (`news_id`,`created_by`,`title`,`description`,`content`,`created`,`url`) values('{$news_id}',{$_SESSION['userid']},'{$title}','{$des}','{$content}','".get_date_time()."','{$url}')"))
echo $news_id;

else 
echo "failed";



?>