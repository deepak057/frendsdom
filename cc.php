<?php

$mysqli=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_status_view_db");

$mysqli1=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_posts_record");


for($i=2001;$i<=3840;$i++){


if($result=$mysqli->query("select * from status_view_of_user{$i}"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{


$query="update status_view_of_user{$i} set `date`='".update_records($mysqli1,$row['fromid'],$row['post_id'])."' where post_id='".$row['post_id']."'";


if($mysqli->query($query))echo "success ";else echo "failed ";



}
}
}





}



function update_records($mysqli,$fromid,$post_id){


if($result=$mysqli->query("select `created` from posts_record_of_user{$fromid} where post_id='{$post_id}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

return $row['created'];

}
}
}







}




?>