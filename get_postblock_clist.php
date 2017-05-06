<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

//get default color
$color=entity_value("userdata","post_block_back","id",$_SESSION['userid']);

foreach (get_vp_colors() as $cl){

?>

<li id="pb_<?php echo str_replace("#","",$cl); ?>" style="background:<?php echo $cl; ?>;" onclick="update_pbb_value(this,'<?php echo $cl; ?>');" onmouseover="$('.hp_post_container').css('background','<?php echo $cl; ?>');" onmouseout="$('.hp_post_container').css('background','<?php echo $color;?>');">&nbsp;</li>
<?php
}

}

else
{
header('location:home.php');
}
?>