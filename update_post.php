<?php

/*
//preventing direct access to this script
if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
{
header('location:home.php');
exit;
}
*/

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['value']))
{

//manipulating received id's value to extract post's id
$_POST['id']=str_replace("pc_","",$_POST['id']);

if(update_entity("posts_record_of_user{$_SESSION['userid']}","post_id",$_POST['id'],"post_content",htmlentities(addslashes(trim($_POST['value']))),$posts_db))
echo nl2br(auto_link_text($_POST['value']));

}
else
{
header('location:home.php');
}
?>