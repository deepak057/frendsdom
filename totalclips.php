<?php


include("environment.php");
check_auth();




$dbLink =new mysqli($host,$db_user,$db_passwd,$soundclips_db);
if(mysqli_connect_errno()){die("MySQL connection failed: ". mysqli_connect_error());}

$r=$dbLink->query("select *from soundclipsofuser{$_SESSION['id']} where set1='yes'");

if($r) 
{         


   
if($r->num_rows >= 1)
echo "1";
}
else echo "0";





?>