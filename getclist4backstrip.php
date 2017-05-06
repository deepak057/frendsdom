<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

//getting any (default 20) random colors
$img_array=get_vp_colors();


$color=entity_value("userdata","back_strip_color","id",$_POST['id']);
for($i=0;$i<sizeof($img_array);$i++){
?>
<li id="<?php echo $img_array[$i];?>" style="background:<?php echo $img_array[$i]; ?>;" onclick="update_value('back_strip_color','<?php echo $img_array[$i];?>');" onmouseover="cl_back('<?php echo $img_array[$i];?>');" onmouseout="cl_back('<?php echo $color;?>');">&nbsp;</li>
<?php
}
}

else if(!empty($_POST['vuid']) && empty($_POST['id'])) 
{

if(if_exists("userdata","id",$_POST['vuid']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['vuid']) && if_exists("authorityrecpients4user".$_SESSION['userid'],'recpient_id',$_POST['vuid'],$authority_recpients_db) && if_exists("authorityrecpients4user".$_POST['vuid'],'recpient_id',$_SESSION['userid'],$authority_recpients_db))
{
//compressing HTML content 
ob_start("ob_gzhandler"); 

//getting any (default 20) random colors
$img_array=get_vp_colors();

$color=entity_value("userdata","back_strip_color","id",$_POST['vuid']);


for($i=0;$i<sizeof($img_array);$i++){
?>
<li id="back_strip_color_<?php echo $img_array[$i];?>" style="background:<?php echo $img_array[$i];?>;" onclick="pa_updateColor('<?php echo $color;?>','<?php echo $img_array[$i];?>','get_backstripclist',this.id);" onmouseover="cl_back('<?php echo $img_array[$i];?>');" onmouseout="cl_back('<?php echo $color;?>');">&nbsp;</li>
<?php
}
}

else header('location:home.php');

}

else
{
header('location:home.php');
}
?>