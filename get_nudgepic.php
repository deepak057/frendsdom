<?php

include("environment.php");
check_auth();

if(!empty($_GET['nudgeset']))
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgesets_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
$sql="select nudgepic from {$_GET['nudgeset']}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(!empty($row['nudgepic']))
{
header('content-type:image');
echo $row['nudgepic'];
}
}
}
}
else echo "No picture found";
}
else
{
header('location:home.php');
}
?>
