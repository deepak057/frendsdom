<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['m2list'])) 
{

if(if_exists("userdata","id",$_POST['id']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['id']) && if_exists("user{$_POST['id']}","listid",$_SESSION['userid']))
{
//function to retrieve the list in which the recpient of the news is
function get_list_status1($userid){$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}$sql="select * from user{$_SESSION['userid']}";if($result=$mysqli->query($sql)){if($result->num_rows>0){while($row=$result->fetch_array()){if(!empty($row['familyid'])){if($row['familyid']==$userid){return "familyid";break;}}if(!empty($row['friendid'])){if($row['friendid']==$userid){return "friendid";break;}}if(!empty($row['colid'])){if($row['colid']==$userid){return "colid";break;}}if(!empty($row['aquid'])){if($row['aquid']==$userid){return "aquid";break;}}if(!empty($row['noid'])){if($row['noid']==$userid){return "noid";break;}}}}}}

//updating table
$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
$sql="update user{$_SESSION['userid']} set ".get_list_status1($_POST['id'])."='' ,{$_POST['m2list']}='{$_POST['id']}',when1='".date('Y-m-d H:i:s')."' where listid='{$_POST['id']}'";
if($mysqli->query($sql)===true)
{
echo "1";
}

else {echo "0";}

}

else 
{
echo "<b>Error :</b> you don't have privilege/authority to perform this action ";
}
}
else 
{
header('location:home.php');
}

?>