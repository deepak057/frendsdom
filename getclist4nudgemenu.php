<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

$color=entity_value("userdata","nudgemenu_color","id",$_POST['id']);
?>

<li id="#FF69B4" style="background:#FF69B4;" onclick="update_value('nudgemenu_color','#FF69B4','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#FF69B4';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#FFD700" style="background:#FFD700;" onclick="update_value('nudgemenu_color','#FFD700','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#FFD700';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="#00FA9A" style="background:#00FA9A;" onclick="update_value('nudgemenu_color','#00FA9A','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#00FA9A';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="#7CFC00" style="background:#7CFC00;" onclick="update_value('nudgemenu_color','#7CFC00','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#7CFC00';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#90EE90" style="background:#90EE90;" onclick="update_value('nudgemenu_color','#90EE90','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#90EE90';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#CD853F" style="background:#CD853F;" onclick="update_value('nudgemenu_color','#CD853F','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#CD853F';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#E6E6FA" style="background:#E6E6FA;" onclick="update_value('nudgemenu_color','#E6E6FA','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#E6E6FA';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="#EEE8AA" style="background:#EEE8AA;" onclick="update_value('nudgemenu_color','#EEE8AA','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#EEE8AA';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#FFB6C1" style="background:#FFB6C1;" onclick="update_value('nudgemenu_color','#FFB6C1','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#FFB6C1';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#D3D3D3" style="background:#D3D3D3;" onclick="update_value('nudgemenu_color','#D3D3D3','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#D3D3D3';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#9370D8" style="background:#9370D8;" onclick="update_value('nudgemenu_color','#9370D8','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#9370D8';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="#FF8C00" style="background:#FF8C00;" onclick="update_value('nudgemenu_color','#FF8C00','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#FF8C00';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#2F4F4F" style="background:#2F4F4F;" onclick="update_value('nudgemenu_color','#2F4F4F','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#2F4F4F';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#00BFFF" style="background:#00BFFF;" onclick="update_value('nudgemenu_color','#00BFFF','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#00BFFF';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#F0F8FF" style="background:#F0F8FF;" onclick="update_value('nudgemenu_color','#F0F8FF','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#F0F8FF';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li>
<li id="#DAA520" style="background:#DAA520;" onclick="update_value('nudgemenu_color','#DAA520','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#DAA520';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#FFFF99" style="background:#FFFF99;" onclick="update_value('nudgemenu_color','#FFFF99','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#FFFF99';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#FF9999" style="background:#FF9999;" onclick="update_value('nudgemenu_color','#FF9999','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#FF9999';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li><li id="#87CEEB" style="background:#87CEEB;" onclick="update_value('nudgemenu_color','#87CEEB','<?php  echo $color; ?>');" onmouseover="el('nudgemenu').style.background='#87CEEB';" onmouseout="el('nudgemenu').style.background='<?php echo $color;?>';">&nbsp;</li>

<?php
}
else
{
header('location:home.php');
}
?>