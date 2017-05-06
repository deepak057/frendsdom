<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

?>
<?php
$nudgemenucolor=entity_value('userdata','nudgemenu_color','id',$_SESSION['userid']);
$strip_color="red";
?>
<div id="nudgemenu" style="visibility:visible;"> 
<span id="change_nudgemenucolor" style="position:absolute;top:10px;left:;cursor:pointer;"  onclick="show_colorlist('nudgemenu_color')" ><img id="down_arrow" src="rightnew.png" height="15" width="20" title="Change the color of this menu"></span><span id="nudgemenu_color" style="visibility:hidden;position:absolute;top:10px;left:-130px;" class="colorlist"><li id="#FF69B4" style="background:#FF69B4;" onclick="modify_value('nudgemenu_color','#FF69B4','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#FF69B4';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#FFD700" style="background:#FFD700;" onclick="modify_value('nudgemenu_color','#FFD700','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#FFD700';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li>
<li id="#00FA9A" style="background:#00FA9A;" onclick="update_value('nudgemenu_color','#00FA9A','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#00FA9A';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li>
<li id="#7CFC00" style="background:#7CFC00;" onclick="update_value('nudgemenu_color','#7CFC00','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#7CFC00';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#90EE90" style="background:#90EE90;" onclick="update_value('nudgemenu_color','#90EE90','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#90EE90';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#CD853F" style="background:#CD853F;" onclick="update_value('nudgemenu_color','#CD853F','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#CD853F';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#E6E6FA" style="background:#E6E6FA;" onclick="update_value('nudgemenu_color','#E6E6FA','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#E6E6FA';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li>
<li id="#EEE8AA" style="background:#EEE8AA;" onclick="update_value('nudgemenu_color','#EEE8AA','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#EEE8AA';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#FFB6C1" style="background:#FFB6C1;" onclick="update_value('nudgemenu_color','#FFB6C1','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#FFB6C1';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#D3D3D3" style="background:#D3D3D3;" onclick="update_value('nudgemenu_color','#D3D3D3','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#D3D3D3';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#9370D8" style="background:#9370D8;" onclick="update_value('nudgemenu_color','#9370D8','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#9370D8';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li>
<li id="#FF8C00" style="background:#FF8C00;" onclick="update_value('nudgemenu_color','#FF8C00','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#FF8C00';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#2F4F4F" style="background:#2F4F4F;" onclick="update_value('nudgemenu_color','#2F4F4F','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#2F4F4F';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#00BFFF" style="background:#00BFFF;" onclick="update_value('nudgemenu_color','#00BFFF','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#00BFFF';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#F0F8FF" style="background:#F0F8FF;" onclick="update_value('nudgemenu_color','#F0F8FF','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#F0F8FF';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li>
<li id="#DAA520" style="background:#DAA520;" onclick="update_value('nudgemenu_color','#DAA520','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#DAA520';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#FFFF99" style="background:#FFFF99;" onclick="update_value('nudgemenu_color','#FFFF99','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#FFFF99';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#FF9999" style="background:#FF9999;" onclick="update_value('nudgemenu_color','#FF9999','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#FF9999';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li><li id="#87CEEB" style="background:#87CEEB;" onclick="update_value('nudgemenu_color','#87CEEB','<?php echo $nudgemenucolor;?>');" onmouseover="el('nudgemenu').style.background='#87CEEB';" onmouseout="el('nudgemenu').style.background='<?php echo $nudgemenucolor;?>';">&nbsp;</li></span>
<?php echo "<span id='nudgenames' style='font-size:1.2em;'>Nudging <b>".user_name($_POST['id'])."</b></span>";?>&nbsp;&nbsp;<input type="button" style="font-size:1.2em;background:grey;border:1px solid grey;" id="addmorebtn" value="+" title="Include others too" onclick="includeOthers();" ><div style="position:relative;top:10px;" id="addmoretext"></div>
<p id="ieltext"><a href="javascript:includelst()" style="color:black;text-decoration:underline;" onmouseover="this.style.color='grey';this.style.background='none';" onmouseout="this.style.color='black';">Include entire list</a></p>
<form name="nudgeform" id="nudgeform" method="post" action="nudge.php" enctype="multipart/form-data" target="upload_target" onsubmit="nudge();">
<div id="includelist" style="width:450px;padding:10px 0px 10px 10px;font-size:.8em;margin-top:30px;"></div>
<div style="position:relative;">
<p><spam style="position:absolute;top:40px;">Nudge text</br>(Max 100 </br> char)</spam>&nbsp;&nbsp;&nbsp;<textarea style="position:relative;top:40px;left:70px;font-family:sans-serif;" name="nudgetext" cols="40" rows="3" class="flexible_textarea" maxlength="100"></textarea></p>
</div>
</br></br><b>Optionals :</b>
</br></br>Nudging clip&nbsp;<input type="file" name="nudgeclip" size="41" onmouseover="myTimer=setTimeout('show_payAttention()', 1500);el('beforeupload').innerHTML='<b>Pay attention:</b><p>Make sure that you upload a sound file with <b>.wave</b> extenision and size of file does not exceed <b>800kb</b></p> ';" onmouseout='clearTimeout(myTimer);myTimer=setTimeout("hide_payAttention()", 55000);'/>
<p>Nudge pic&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="nudgepic" size="41" onmouseover="myTimer=setTimeout('show_payAttention()', 1500);el('beforeupload').innerHTML='<b>Pay attention:</b><p>Make sure that you upload an image file with <b>.jpg</b> or <b>.gif</b> extenision and size of file does not exceed <b>800kb</b></p>';" onmouseout='clearTimeout(myTimer);myTimer=setTimeout("hide_payAttention()", 55000);' /></p>
<p id="known"></p>				
<p style="position:relative;left:150px;"></br><input type="hidden" name="userlist" value="<?php echo $_POST['id'];?>"><input type="hidden" name="list1" value=""><input type="hidden" name="send" value="yes"><input type="submit" id="btn"  value="Nudge now"><input type="button" id="btn" value="Close" onclick='$("#nudgemenu").hide("slow");el("nudge_space").style.opacity="1";el("addmoretext").innerHTML=" ";$("#addmorebtn").show();el("reply_to_nudge").innerHTML=inner("temp_data");'></p></form><div id="beforeupload" style="position:relative;left:-260px;"></div>
</div>
<span id="nudgelist">
<div id="userinlistmsg"></div>
<iframe id="upload_target" name="upload_target" src="#" style="width:0px;height:0px;border:0px solid #fff;"></iframe>
<?php
}
else
{
header('location:home.php');
}
?>