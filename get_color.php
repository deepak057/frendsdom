<?php 

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['component']))
{

if(in_array(trim($_POST['component']),array("back_strip_color","visit_buttonset","nudgemenu_color","visit_backg","rel_color","comments_backg")))
{
echo entity_value("userdata",$_POST['component'],"id",$_POST['id']);
}
else echo "Error: failed";
}
else
{
header("location:home.php");
}
?>
