<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

$color=entity_value("userdata","visit_buttonset","id",$_POST['id']);
?>

<li id="b#FF69B4" style="background:#FF69B4;" onclick="updatebtnsetcolor('<?php echo $color;?>','#FF69B4');" onmouseover="changebtnsetcolor('#FF69B4');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#FFD700" style="background:#FFD700;" onclick="updatebtnsetcolor('<?php echo $color;?>','#FFD700');" onmouseover="changebtnsetcolor('#FFD700');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#00FA9A" style="background:#00FA9A;" onclick="updatebtnsetcolor('<?php echo $color;?>','#00FA9A');" onmouseover="changebtnsetcolor('#00FA9A');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#7CFC00" style="background:#7CFC00;" onclick="updatebtnsetcolor('<?php echo $color;?>','#7CFC00');" onmouseover="changebtnsetcolor('#7CFC00');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#90EE90" style="background:#90EE90;" onclick="updatebtnsetcolor('<?php echo $color;?>','#90EE90');" onmouseover="changebtnsetcolor('#90EE90');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#CD853F" style="background:#CD853F;" onclick="updatebtnsetcolor('<?php echo $color;?>','#CD853F');" onmouseover="changebtnsetcolor('#CD853F');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#E6E6FA" style="background:#E6E6FA;" onclick="updatebtnsetcolor('<?php echo $color;?>','#E6E6FA');" onmouseover="changebtnsetcolor('#E6E6FA');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#EEE8AA" style="background:#EEE8AA;" onclick="updatebtnsetcolor('<?php echo $color;?>','#EEE8AA');" onmouseover="changebtnsetcolor('#EEE8AA');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#FFB6C1" style="background:#FFB6C1;" onclick="updatebtnsetcolor('<?php echo $color;?>','#FFB6C1');" onmouseover="changebtnsetcolor('#FFB6C1');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#D3D3D3" style="background:#D3D3D3;" onclick="updatebtnsetcolor('<?php echo $color;?>','#D3D3D3');" onmouseover="changebtnsetcolor('#D3D3D3');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#9370D8" style="background:#9370D8;" onclick="updatebtnsetcolor('<?php echo $color;?>','#9370D8');" onmouseover="changebtnsetcolor('#9370D8');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#FF8C00" style="background:#FF8C00;" onclick="updatebtnsetcolor('<?php echo $color;?>','#FF8C00');" onmouseover="changebtnsetcolor('#FF8C00');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#2F4F4F" style="background:#2F4F4F;" onclick="updatebtnsetcolor('<?php echo $color;?>','#2F4F4F');" onmouseover="changebtnsetcolor('#2F4F4F');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#00BFFF" style="background:#00BFFF;" onclick="updatebtnsetcolor('<?php echo $color;?>','#00BFFF');" onmouseover="changebtnsetcolor('#00BFFF');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#F0F8FF" style="background:#F0F8FF;" onclick="updatebtnsetcolor('<?php echo $color;?>','#F0F8FF');" onmouseover="changebtnsetcolor('#F0F8FF');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#DAA520" style="background:#DAA520;" onclick="updatebtnsetcolor('<?php echo $color;?>','#DAA520');" onmouseover="changebtnsetcolor('#DAA520');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#FFFF99" style="background:#FFFF99;" onclick="updatebtnsetcolor('<?php echo $color;?>','#FFFF99');" onmouseover="changebtnsetcolor('#FFFF99');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#FF9999" style="background:#FF9999;" onclick="updatebtnsetcolor('<?php echo $color;?>','#FF9999');" onmouseover="changebtnsetcolor('#FF9999');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>
<li id="b#87CEEB" style="background:#87CEEB;" onclick="updatebtnsetcolor('<?php echo $color;?>','#87CEEB');" onmouseover="changebtnsetcolor('#87CEEB');" onmouseout="changebtnsetcolor('<?php echo $color;?>');">&nbsp;</li>

<?php
}

else if(!empty($_POST['vuid']) && empty($_POST['id'])) 
{

if(if_exists("userdata","id",$_POST['vuid']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['vuid']) && if_exists("authorityrecpients4user".$_SESSION['userid'],'recpient_id',$_POST['vuid'],$authority_recpients_db) && if_exists("authorityrecpients4user".$_POST['vuid'],'recpient_id',$_SESSION['userid'],$authority_recpients_db))
{
//compressing HTML content 
//ob_start("ob_gzhandler"); 

$color=entity_value("userdata","visit_buttonset","id",$_POST['vuid']);
?>

<li id="visit_buttonset_#FF69B4" style="background:#FF69B4;" onclick="pa_updateColor('<?php echo $color;?>','#FF69B4','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#FF69B4';}"  onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#FFD700" style="background:#FFD700;" onclick="pa_updateColor('<?php echo $color;?>','#FFD700','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#FFD700';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#00FA9A" style="background:#00FA9A;" onclick="pa_updateColor('<?php echo $color;?>','#00FA9A','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#00FA9A';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#7CFC00" style="background:#7CFC00;" onclick="pa_updateColor('<?php echo $color;?>','#7CFC00','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#7CFC00';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#90EE90" style="background:#90EE90;" onclick="pa_updateColor('<?php echo $color;?>','#90EE90','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#90EE90';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#CD853F" style="background:#CD853F;" onclick="pa_updateColor('<?php echo $color;?>','#CD853F','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#CD853F';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#E6E6FA" style="background:#E6E6FA;" onclick="pa_updateColor('<?php echo $color;?>','#E6E6FA','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#E6E6FA';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#EEE8AA" style="background:#EEE8AA;" onclick="pa_updateColor('<?php echo $color;?>','#EEE8AA','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#EEE8AA';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#FFB6C1" style="background:#FFB6C1;" onclick="pa_updateColor('<?php echo $color;?>','#FFB6C1','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#FFB6C1';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#D3D3D3" style="background:#D3D3D3;" onclick="pa_updateColor('<?php echo $color;?>','#D3D3D3','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#D3D3D3';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#9370D8" style="background:#9370D8;" onclick="pa_updateColor('<?php echo $color;?>','#9370D8','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#9370D8';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#FF8C00" style="background:#FF8C00;" onclick="pa_updateColor('<?php echo $color;?>','#FF8C00','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#FF8C00';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#2F4F4F" style="background:#2F4F4F;" onclick="pa_updateColor('<?php echo $color;?>','#2F4F4F','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#2F4F4F';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#00BFFF" style="background:#00BFFF;" onclick="pa_updateColor('<?php echo $color;?>','#00BFFF','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#00BFFF';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#F0F8FF" style="background:#F0F8FF;" onclick="pa_updateColor('<?php echo $color;?>','#F0F8FF','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#F0F8FF';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#DAA520" style="background:#DAA520;" onclick="pa_updateColor('<?php echo $color;?>','#DAA520','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#DAA520';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#FFFF99" style="background:#FFFF99;" onclick="pa_updateColor('<?php echo $color;?>','#FFFF99','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#FFFF99';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#FF9999" style="background:#FF9999;" onclick="pa_updateColor('<?php echo $color;?>','#FF9999','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#FF9999';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>
<li id="visit_buttonset_#87CEEB" style="background:#87CEEB;" onclick="pa_updateColor('<?php echo $color;?>','#87CEEB','btnset',this.id);" onmouseover="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='#87CEEB';}" onmouseout="for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $color;?>';}">&nbsp;</li>

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