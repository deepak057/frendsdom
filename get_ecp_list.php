<?php

include("environment.php");
check_auth();

$pic_list=return_array_tweaked($eyecandy_db,"eyecandy_pics_of_user{$_SESSION['userid']}","pic_id");
header("content-type:text/xml");
echo "<data><total>".sizeof($pic_list)."</total>";
for($i=($_GET['first']);$i<($_GET['last']);$i++)
{
echo "<image>get_ecp.php?pic_id={$pic_list[$i]}</image>";
}
echo "</data>";
?>