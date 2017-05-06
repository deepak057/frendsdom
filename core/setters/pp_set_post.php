<?php

//connect to database
$mysqli =new mysqli($host,$db_user,$db_passwd,$status_view_db);

if($_REQUEST['action']==ADD){
$query="insert into status_view_of_user{$_REQUEST['uid']} (fromid,post_id,promotional_points) values(".uid().",'{$_REQUEST['post_id']}',{$_REQUEST['points']})";
}

else {
$query="delete from status_view_of_user{$_REQUEST['uid']} where post_id='{$_REQUEST['post_id']}'";
}

//execute query to insert/delete post
if($mysqli->query($query)){

//update points on logged-in user's account
update_points(uid(),$_REQUEST['points'],($_REQUEST['action']==ADD?"deduce":ADD));

//confirm success
echo "1";
}


else {

echo "0";

}



?>