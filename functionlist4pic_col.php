<?php
//function to determine total entries in specified table for specified entity

function total_entries1($table,$entity)
{
$connect = mysql_connect("localhost", "frendryg_root", "#Pooja1957_root") or die ("unable to connect");
mysql_select_db("frendryg_picdata", $connect);
$result = mysql_query("SELECT COUNT(*) FROM {$table} where {$entity}!='' ") or die(mysql_error());
return mysql_result($result, 0);
}

//function for retreiving array of entries for a specified entity

function return_array1($table,$entity,$id=null,$idvalue=null)
{
if( (!empty($table)) && (!empty($entity)))
{

$list=array();
$i=0;

$mysqli =new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_picdata");
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if(!empty($id) && !empty($idvalue))
{
$sql="select {$entity} from {$table} where {$id}='{$idvalue}'";
}
else
{
$sql="select {$entity} from {$table}";
}
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
$list[$i]=$row[$entity];
$i++;
}
}
}

return $list;

}
else return null;
}
//function for getting an entity's value for specified id

function entity_value1($table,$entity,$id,$idvalue)
{
if( (!empty($table)) && (!empty($id)) && (!empty($entity)) && (!empty($idvalue)))
{
$mysqli =new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_picdata");
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select {$entity} from {$table} where {$id}='{$idvalue}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row[$entity]))
return $row[$entity];
else return null;

}
}
else echo "failed";
}
}
else return null;
}


//function for updating the value of an entity

function update_entity1($table,$id,$idvalue,$entity,$value)
{
if((!empty($table))  && (!empty($id)) && (!empty($entity)) && (!empty($value)) )
{
$mysqli =new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_picdata");
if($mysqli===false)
{
die("Could not connect to database");
}
$sql2="update {$table} set {$entity}='{$value}' where {$id}='{$idvalue}'";
if($mysqli->query($sql2)===true)
return true;
else return false;
}
else return null;
}

//function to delete a row from a specified table
function delete_row1($table,$id,$idvalue){if((!empty($table))  && (!empty($id)) ){$mysqli =new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_picdata");if($mysqli===false){die("Could not connect to database");}$sql2="delete from {$table} where {$id}='{$idvalue}'";if($mysqli->query($sql2)===true)return true;else return false;}else return null;}


?>