<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_id'])&& !empty($_POST['pic_id']))
{

$mysqli =new mysqli($host,$db_user,$db_passwd,$picdata_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($result=$mysqli->query("select * from {$_POST['col_id']} where pic_id='{$_POST['pic_id']}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(!empty($row['pic_data']))
{

if(set_prof_pic($row['pic_type'],"300",$row['pic_name'],$row['pic_data']))
{
update_entity("userdata","id",$_SESSION['userid'],"picture","yes",$selected_db);
echo '1';
}
else echo '0';

}
}
}
}
}
else 
{
header('location:home.php');
}
 
?>