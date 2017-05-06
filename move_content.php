<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['action'])) 
{

//compressing HTML content 
ob_start("ob_gzhandler");

if(if_exists("userdata","id",$_POST['id']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['id']) && if_exists("user{$_POST['id']}","listid",$_SESSION['userid']))
{
function put_lists(){$con=mysql_connect($GLOBALS['host'],$GLOBALS["db_user"],$GLOBALS["db_passwd"]);if (!$con) { die('Error: Could not connect: ' . mysql_error()); }mysql_select_db($GLOBALS["selected_db"]);$query = "select * from user{$_SESSION['userid']}"; $result = mysql_query($query); if (!$result) { die("Database-related error occured"); } else {$i = 0; echo "<select name='m2list' id='m2list'><option value=''>......Choose....</option>";while ($i < mysql_num_fields($result)) { $meta = mysql_fetch_field($result, $i);if($meta->name!="No" && $meta->name!="type" && $meta->name!="requestid" && $meta->name!="listid" && $meta->name!="when1" && $meta->name!="points"){echo "<option value='{$meta->name}'>";if($meta->name=="friendid")$meta->name="Friend";if($meta->name=="familyid")$meta->name="Family";if($meta->name=="colid")$meta->name="Colleague";if($meta->name=="aquid")$meta->name="Acquaintance";if($meta->name=="aquid")$meta->name="Acquaintance";if($meta->name=="noid")$meta->name="No prior acquaintance";echo $meta->name."</option>";}$i++;}}echo "</select>";}

//deriving appropriate noun for user depending upon user's sex
if(user_sex($_POST['id'])=="female")$h='her';else $h='him';

//deciding appropriate title for the menu
if($_POST['action']=="move")$title="Moving to other list";else $title="Removing relation";

//displaying content
echo "<table cellspacing='5'>
<tr>
<td><h3>{$title}</h3>
<span style='position:absolute;top:59px;' class='light_text small'><b>".user_name($_POST['id'])."</b> has been in your <b>".get_list_status($_POST['id'])."</b> list since ".entity_value("user{$_SESSION['userid']}","DATE_FORMAT(when1,'%d %M %Y')","listid",$_POST['id'])."</span>
</td><td align='right' valign='top'><span  class='red_onhover' onclick='hide_otherAction();' title='Close'>&#215;</span></td>
</tr>
<tr>";

if($_POST['action']=="move")
{
echo "
<td>
</br>
Move {$h} to ";
put_lists();
echo " list</br></br><input type='button' value='Move' class='special_btn' id='m2list_btn'>
</td>";
}

else 
{
echo "<td></br>Are you sure you want to remove {$h} </br>from your relation list?
</br></br><input type='button' value='Proceed' class='special_btn redback' id='remove_btn'><input type='button' class='btn' value='Cancel' onclick='hide_otherAction();'></td>";
}

echo "<td>
<img src='".prof_pic($_POST['id'])."' height='150' width='150'>
</td>
</tr>
</table>";
}

else 
{
if(user_sex($_POST['id'])=="female")$h='her';else $h='him';
echo "<table cellspacing='4'>
<tr>
<td ><h3><img src='alert.gif' align='middle'>Sorry, you are unprivileged</h3>
</td><td align='right' valign='top'><span  class='red_onhover' onclick='hide_otherAction();' title='Close'>&#215;</span></td>
</tr>
<tr>
<td>
You must have {$h} in any of your relation lists</br>to be able to perform this action.</br></br><input type='button' value='Okay' style='background:grey;' class='special_btn' onclick='hide_otherAction();'>
</td>
<td>
<img src='".prof_pic($_POST['id'])."' height='150' width='150'>
</td>
</tr>
</table>";
}
}
else 
{
header('location:home.php');
}
?>