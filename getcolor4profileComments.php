<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

$color=entity_value("userdata","comments_backg","id",$_POST['id']);
?>

<li id="cm#FF69B4" style="background:#FF69B4;" onclick="update_cm('<?php echo $color;?>','#FF69B4');" onmouseover="el('profile_comments').style.background='#FF69B4';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#FFD700" style="background:#FFD700;" onclick="update_cm('<?php echo $color;?>','#FFD700');" onmouseover="el('profile_comments').style.background='#FFD700';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#00FA9A" style="background:#00FA9A;" onclick="update_cm('<?php echo $color;?>','#00FA9A');" onmouseover="el('profile_comments').style.background='#00FA9A';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#7CFC00" style="background:#7CFC00;" onclick="update_cm('<?php echo $color;?>','#7CFC00');" onmouseover="el('profile_comments').style.background='#7CFC00';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#90EE90" style="background:#90EE90;" onclick="update_cm('<?php echo $color;?>','#90EE90');" onmouseover="el('profile_comments').style.background='#90EE90';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#CD853F" style="background:#CD853F;" onclick="update_cm('<?php echo $color;?>','#CD853F');" onmouseover="el('profile_comments').style.background='#CD853F';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#E6E6FA" style="background:#E6E6FA;" onclick="update_cm('<?php echo $color;?>','#E6E6FA');" onmouseover="el('profile_comments').style.background='#E6E6FA';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#EEE8AA" style="background:#EEE8AA;" onclick="update_cm('<?php echo $color;?>','#EEE8AA');" onmouseover="el('profile_comments').style.background='#EEE8AA';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#FFB6C1" style="background:#FFB6C1;" onclick="update_cm('<?php echo $color;?>','#FFB6C1');" onmouseover="el('profile_comments').style.background='#FFB6C1';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#D3D3D3" style="background:#D3D3D3;" onclick="update_cm('<?php echo $color;?>','#D3D3D3');" onmouseover="el('profile_comments').style.background='#D3D3D3';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#9370D8" style="background:#9370D8;" onclick="update_cm('<?php echo $color;?>','#9370D8');" onmouseover="el('profile_comments').style.background='#9370D8';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#FF8C00" style="background:#FF8C00;" onclick="update_cm('<?php echo $color;?>','#FF8C00');" onmouseover="el('profile_comments').style.background='#FF8C00';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#2F4F4F" style="background:#2F4F4F;" onclick="update_cm('<?php echo $color;?>','#2F4F4F');" onmouseover="el('profile_comments').style.background='#2F4F4F';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#00BFFF" style="background:#00BFFF;" onclick="update_cm('<?php echo $color;?>','#00BFFF');" onmouseover="el('profile_comments').style.background='#00BFFF';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#F0F8FF" style="background:#F0F8FF;" onclick="update_cm('<?php echo $color;?>','#F0F8FF');" onmouseover="el('profile_comments').style.background='#F0F8FF';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#DAA520" style="background:#DAA520;" onclick="update_cm('<?php echo $color;?>','#DAA520');" onmouseover="el('profile_comments').style.background='#DAA520';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#FFFF99" style="background:#FFFF99;" onclick="update_cm('<?php echo $color;?>','#FFFF99');" onmouseover="el('profile_comments').style.background='#FFFF99';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#FF9999" style="background:#FF9999;" onclick="update_cm('<?php echo $color;?>','#FF9999');" onmouseover="el('profile_comments').style.background='#FF9999';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cmwhite" style="background:white;" onclick="update_cm('<?php echo $color;?>','white');" onmouseover="el('profile_comments').style.background='white';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="cm#87CEEB" style="background:#87CEEB;" onclick="update_cm('<?php echo $color;?>','#87CEEB');" onmouseover="el('profile_comments').style.background='#87CEEB';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<?php
}

else if(!empty($_POST['vuid']) && empty($_POST['id'])) 
{

if(if_exists("userdata","id",$_POST['vuid']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['vuid']) && if_exists("authorityrecpients4user".$_SESSION['userid'],'recpient_id',$_POST['vuid'],$authority_recpients_db) && if_exists("authorityrecpients4user".$_POST['vuid'],'recpient_id',$_SESSION['userid'],$authority_recpients_db))
{
//compressing HTML content 
//ob_start("ob_gzhandler"); 

$color=entity_value("userdata","comments_backg","id",$_POST['vuid']);
?>
<li id="comments_backg_#FF69B4" style="background:#FF69B4;" onclick="pa_updateColor('<?php echo $color;?>','#FF69B4','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#FF69B4';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#FFD700" style="background:#FFD700;" onclick="pa_updateColor('<?php echo $color;?>','#FFD700','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#FFD700';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#00FA9A" style="background:#00FA9A;" onclick="pa_updateColor('<?php echo $color;?>','#00FA9A','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#00FA9A';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#7CFC00" style="background:#7CFC00;" onclick="pa_updateColor('<?php echo $color;?>','#7CFC00','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#7CFC00';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#90EE90" style="background:#90EE90;" onclick="pa_updateColor('<?php echo $color;?>','#90EE90','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#90EE90';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#CD853F" style="background:#CD853F;" onclick="pa_updateColor('<?php echo $color;?>','#CD853F','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#CD853F';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#E6E6FA" style="background:#E6E6FA;" onclick="pa_updateColor('<?php echo $color;?>','#E6E6FA','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#E6E6FA';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#EEE8AA" style="background:#EEE8AA;" onclick="pa_updateColor('<?php echo $color;?>','#EEE8AA','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#EEE8AA';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#FFB6C1" style="background:#FFB6C1;" onclick="pa_updateColor('<?php echo $color;?>','#FFB6C1','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#FFB6C1';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#D3D3D3" style="background:#D3D3D3;" onclick="pa_updateColor('<?php echo $color;?>','#D3D3D3','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#D3D3D3';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#9370D8" style="background:#9370D8;" onclick="pa_updateColor('<?php echo $color;?>','#9370D8','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#9370D8';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#FF8C00" style="background:#FF8C00;" onclick="pa_updateColor('<?php echo $color;?>','#FF8C00','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#FF8C00';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#2F4F4F" style="background:#2F4F4F;" onclick="pa_updateColor('<?php echo $color;?>','#2F4F4F','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#2F4F4F';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#00BFFF" style="background:#00BFFF;" onclick="pa_updateColor('<?php echo $color;?>','#00BFFF','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#00BFFF';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#F0F8FF" style="background:#F0F8FF;" onclick="pa_updateColor('<?php echo $color;?>','#F0F8FF','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#F0F8FF';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#DAA520" style="background:#DAA520;" onclick="pa_updateColor('<?php echo $color;?>','#DAA520','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#DAA520';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#FFFF99" style="background:#FFFF99;" onclick="pa_updateColor('<?php echo $color;?>','#FFFF99','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#FFFF99';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#FF9999" style="background:#FF9999;" onclick="pa_updateColor('<?php echo $color;?>','#FF9999','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#FF9999';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_white" style="background:white;" onclick="pa_updateColor('<?php echo $color;?>','white','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='white';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="comments_backg_#87CEEB" style="background:#87CEEB;" onclick="pa_updateColor('<?php echo $color;?>','#87CEEB','getcolor4profileComments',this.id);" onmouseover="el('profile_comments').style.background='#87CEEB';" onmouseout="el('profile_comments').style.background='<?php echo $color;?>';">&nbsp;</li>
<?php
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