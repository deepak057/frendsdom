<?php
/*
include('global_vars.php');



$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],"frendryg_status_view_db");
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}

for($i=1;$i<=2804;$i++){

/*$sql="SELECT EXISTS(
  SELECT 1
  FROM information_schema.columns
  WHERE table_schema = 'db'
     and table_name='status_view_of_user{$i}'
     and column_key = 'PRI'
) As HasPrimaryKey
";
*/

$sql="SHOW KEYS FROM status_view_of_user{$i} WHERE Key_name = 'PRIMARY'" ;



if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{

//echo $row['HasPrimaryKey']." ";

//if(!$row['HasPrimaryKey']) echo $i." ";

}
}

else {

echo $i." ";

}

}


/*
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{

while ($meta = $result->fetch_field()) {

$found="no";
    if ($meta->flags && MYSQLI_PRI_KEY_FLAG) { 
     
$found="yes";
    }


echo $found.$i." ";

}


}
}*/






}*/