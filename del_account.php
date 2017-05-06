<?php 

include("environment.php");
check_auth();

if(!empty($_POST['del_type']) && in_array($_POST['del_type'],array("perm","temp")) && !empty($_POST['pass']))
{

if(sha1($_POST['pass'])==$_SESSION['userkey'])
{
if($_POST['del_type']=="temp")
{
if(update_entity("userdata","id",$_SESSION['userid'],"account_status",$_POST['del_type'])){
remove_allCookies();session_destroy();
echo '1';
}
else echo '0';
}
else
{
if(update_entity("userdata","id",$_SESSION['userid'],"user_id",$_SESSION['userid']."_".mktime()) && update_entity("userdata","id",$_SESSION['userid'],"account_status","perm_".$_SESSION['username'])){
remove_allCookies();session_destroy();
echo 1;
}
else echo '0';
}

}
else
{
echo '0';
}


}


else
{
header('location:home.php');
}
?>