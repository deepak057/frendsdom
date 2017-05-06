<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

//getting any (default 20) random images
$img_array=get_vpb_images();

//getting current image
$color=entity_value("userdata","visit_backg","id",$_POST['id']);

for($i=0;$i<sizeof($img_array);$i++){
?>
<li id="pb<?php echo $img_array[$i];?>" style="background:url(<?php echo $vpb_dir.$img_array[$i]; ?>);" onclick="update_pb('<?php echo $color;?>','<?php echo $img_array[$i];?>');" onmouseover="set_vpb('<?php echo $vpb_dir.$img_array[$i]; ?>');" onmouseout="set_vpb('<?php echo $vpb_dir.$color;?>');">&nbsp;</li>
<?php
}
}

else if(!empty($_POST['vuid']) && empty($_POST['id'])) 
{

if(if_exists("userdata","id",$_POST['vuid']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['vuid']) && if_exists("authorityrecpients4user".$_SESSION['userid'],'recpient_id',$_POST['vuid'],$authority_recpients_db) && if_exists("authorityrecpients4user".$_POST['vuid'],'recpient_id',$_SESSION['userid'],$authority_recpients_db))
{
//compressing HTML content 
//ob_start("ob_gzhandler"); 

//getting any (default 20) random images
$img_array=get_vpb_images();

//getting current image
$color=entity_value("userdata","visit_backg","id",$_POST['vuid']);
for($i=0;$i<sizeof($img_array);$i++){
?>
<li id="visit_backg_<?php echo $img_array[$i];?>" style="background:url(<?php echo $vpb_dir.$img_array[$i]; ?>);" onclick="pa_updateColor('<?php echo $color;?>','<?php echo $img_array[$i];?>','page_back',this.id);" onmouseover="set_vpb('<?php echo $vpb_dir.$img_array[$i]; ?>');" onmouseout="set_vpb('<?php echo $vpb_dir.$color;?>');">&nbsp;</li>
<?php
}
}

else
{
header('location:home.php');
}

}

else
{
header('location:home.php');
}
?>