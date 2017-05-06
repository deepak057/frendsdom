<?php

if(!empty($_REQUEST['post_ids'])){

//get the post ids
$post_ids=enclose_array_elements(json_decode(stripslashes($_REQUEST['post_ids'])));

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);

//update Status view of logged-in user
$mysqli->query("update status_view_of_user".uid()." set seen=1 where ". SQL_not_in($post_ids,"post_id",false));

//get total sum of points that are going to be added to logged-in user's account
$result=$mysqli->query("SELECT SUM(promotional_points) FROM status_view_of_user".uid() ." where ".SQL_not_in($post_ids,"post_id",false));

if($result->num_rows>0){
while($row=$result->fetch_array()){

//update points
update_points(uid(),$row[0]);

}
}

//confirm success
echo "1";

}

?>