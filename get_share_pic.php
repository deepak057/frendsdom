<?php

include("environment.php");
check_auth();

if(!empty($_GET['share_id']) && !empty($_GET['id'])) 
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$share_box_db);if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}

if($result=$mysqli->query("select share_pic_data from sboxofuser{$_GET['id']} where share_id='{$_GET['share_id']}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(!empty($row['share_pic_data']))
{
header('content-type:image');
echo $row['share_pic_data'];
}
}
}
else echo "<b>Error:</b> No picture found";
}

}

else {

header('location:home.php');

}

?>