<?php

include("environment.php");
check_auth();

if(!empty($_GET['col_id']) && !empty($_GET['pic_id']) )
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$picdata_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($result=$mysqli->query("select pic_data,pic_type from {$_GET['col_id']} where pic_id='{$_GET['pic_id']}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(!empty($row['pic_data']))
{
header("content-type:{$row['pic_type']}");
echo $row['pic_data'];
}
}
}
}
else echo "Error : No picture found";
}
else {
header('location:home.php');
}
?>